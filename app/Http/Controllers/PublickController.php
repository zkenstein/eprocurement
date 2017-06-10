<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Cluster;
use App\UserCluster;
use App\Pengumuman;
use App\PengumumanUser;
use App\PengumumanBarang;
use App\BarangEksternal;
use Mail;

class PublickController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }

    // Cek login umum
	public function loginCheck(Request $request)
	{
        $rules = ['captcha' => 'required|captcha'];
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
        {
            return response()->json(['result'=>false,'message'=>'Masukkan captcha dengan benar', 'captcha_src'=>captcha_src()]);
        }
		$email = $request->input('email');
		$password = $request->input('password');
		$user = User::where(['email'=>$email,'password'=>$password])->first();
		if($user!=null){
            session()->put('role',$user->role);
            session()->put('id',$user->id);
            session()->put('nama',$user->nama);
			return response()->json(['data'=>$user,'result'=>true]);
		}
		return response()->json(['result'=>false,'message'=>'Email ataupun password tidak cocok', 'captcha_src'=>captcha_src()]);
	}

    // Cek subkontraktor yg terdaftar
    public function registerCheck(Request $request)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
        {
            return response()->json(['result'=>false,'message'=>'Masukkan captcha dengan benar', 'captcha_src'=>captcha_src()]);
        }

        $email = $request->input('email');
        $kodeMasuk = $request->input('kode_masuk');
        $pengumuman = $request->input('pengumuman');
        $user = User::where('email',$email)->first();
        if($user!=null){#Jika user ditemukan
            $userPengumuman = PengumumanUser::where('pengumuman_id',$pengumuman)->where('user_id',$user->id)->first();
            if($userPengumuman!=null){#JIKA user terdata dalam tender pal tapi belum daftar
                $statusRegsiter = "daftar";#Default status register daftar
                if($userPengumuman->waktu_register!=null) $statusRegsiter = "login"; #JIKA User sudah melakukan pendaftaran , ganti statusRegister menjadi login
                
                if($statusRegsiter=="daftar"){#Jika statusRegsiter daftar, cek apakah masih ada kuota atau tidak
                    if(strtotime($userPengumuman->pengumumanInfo->batas_awal_waktu_penawaran) <= strtotime(\Carbon\Carbon::now())){#Jika pendaftaran sudah dibuka
                        if(strtotime($userPengumuman->pengumumanInfo->batas_akhir_waktu_penawaran) >= strtotime(\Carbon\Carbon::now())){#Jika pendaftaran masih dibuka
                            if($userPengumuman->kode_masuk==$kodeMasuk){#Jika kode_masuk yang dimasukkan benar
                                $pengumuman = Pengumuman::find($pengumuman);
                                $data['nama_perusahaan'] = $user->nama;
                                $data['kode_pengumuman'] = $pengumuman->kode;
                                $data['waktu_auction'] = $pengumuman->start_auction;
                                $data['durasi_auction'] = $pengumuman->durasi;
                                Mail::queue('mail_followup',$data,function($message)use($user){
                                    $message->to($user->email, $user->nama)->subject("PAL Follow Up Registration");
                                    $message->from(env('MAIL_USERNAME'),"PT.PAL");
                                });
                                $userPengumuman->waktu_register = \Carbon\Carbon::now();
                                $userPengumuman->save();
                                $pengumuman->count_register+=1;
                                $pengumuman->save();
                                session()->put('pengumuman',$pengumuman->id);
                                session()->put('mode','lihat');
                                session()->put('role',$user->role);
                                session()->put('id',$user->id);
                                session()->put('nama',$user->nama);
                                return response()->json(['result'=>true],200);
                            }else{#Jika kode masuk salah
                                return response()->json(['result'=>false,'message'=>'Kode masuk yang anda masukkan salah', 'captcha_src'=>captcha_src()]);
                            }
                        }else{#Jika pendaftaran sudah ditutup
                            return response()->json(['result'=>false,'message'=>'Anda belum melakukan pendaftaran. Pendaftaran sudah ditutup', 'captcha_src'=>captcha_src()]);
                        }
                    }else{#Jika pendaftaran belum dibuka
                        return response()->json(['result'=>false,'message'=>'Pendaftaran belum dibuka', 'captcha_src'=>captcha_src()]);
                    }
                }else{#Jika statusRegister login, cek apakah kode_masuk cocok
                    if($userPengumuman->kode_masuk==$kodeMasuk){#Jika kode_masuk yang dimasukkan benar
                        $pengumuman = Pengumuman::find($pengumuman);
                        session()->put('pengumuman',$pengumuman->id);
                        session()->put('mode','lihat');
                        session()->put('role',$user->role);
                        session()->put('id',$user->id);
                        session()->put('nama',$user->nama);
                        return response()->json(['result'=>true],200);
                    }else{#Jika kode masuk salah
                        return response()->json(['result'=>false,'message'=>'Kode masuk yang anda masukkan salah','captcha_src'=>captcha_src()]);
                    }
                }
            }else{#JIKA User tidak terdaftar dalam tender sama sekali
                return response()->json(['result'=>false,'message'=>'Email anda tidak terdaftar pada tender ini','captcha_src'=>captcha_src()]);
            }
        }else{#Jika user tidak ditemukan
            return response()->json(['result'=>false,'message'=>'Email tidak terdaftar dalam subkontraktor PT.PAL','captcha_src'=>captcha_src()]);
        }
    }

    public function homePage(Request $request)
    {
        // dd(session()->all());
    	$data['TAG'] = 'home';
        $data['captcha_src'] = captcha_src();
        // CEK APAKAH USER SUDAH MASUK SEBAGAI SUBKONTRAKTOR DALAM SEBUAH TENDER ATAU BELUM
        if(session()->has('pengumuman')){#JIKA SUDAH,  MASUK KE TENDER LOAD HALAMAN HOME TENDER
            $pengumumanUser = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->first();
            if($pengumumanUser==null) return redirect()->route('logout');
            $data['total_auction'] = $pengumumanUser->total_auction;
            // MENGAMBIL DATA LIST BARANG INTERNAL YANG DILELANG DAN PENAWARAN USER SEBELUMNYA
            $data['list_barang'] = PengumumanBarang::with(['barangInfo','inUserAuction'])->where('pengumuman_id',session('pengumuman'))->get();
            // MENGAMBIL DATA LIST BARANG EKSTERNAL YANG DILELANG DAN PENAWARAN USER SEBELUMNYA
            $data['list_barang_eksternal'] = BarangEksternal::with('inUserAuction')->where('pengumuman_id',session('pengumuman'))->get();

            $data['isIWin'] = false;
            $data['pengumuman'] = Pengumuman::with(['listCluster.clusterInfo','listBarang.barangInfo','listValidUser'])->find(session('pengumuman'));
            if(  $data['pengumuman']->pemenang!=null  ){
                if($data['pengumuman']->pemenang == session('id')) $data['isIWin'] = true;
                else $data['isIWin'] = false;
            }
            if(strtotime($data['pengumuman']->start_auction) >= strtotime(\Carbon\Carbon::now())){#JIKA BELUM MASUK AUCTION
                $data['countdown'] = \Carbon\Carbon::parse($data['pengumuman']->start_auction)->diffInSeconds(\Carbon\Carbon::now());
                $data['allow_auction'] = false;
            }else if(strtotime(\Carbon\Carbon::parse($data['pengumuman']->start_auction)->addMinutes($data['pengumuman']->durasi)) < strtotime(\Carbon\Carbon::now())){#JIKA SUDAH DITEMUKAN PEMENANG
                $data['countdown'] = 0;
                $data['allow_auction'] = true;
                $data['auction_finish'] = true;
            }else{
                if(count($data['pengumuman']->listValidUser)>1){#JIKA SUDAH MASUK AUCTION DAN USER YANG VALID SUDAH LEBIH DARI 1
                   return redirect()->route('auction');
                    
                }else{#JIKA SUDAH MASUK AUCTION DAN USER YANG VALID BELUM LEBIH DARI 1
                    $data['countdown'] = 0;
                    $data['waiting_for_extends'] = true;
                    $data['allow_auction'] = false;
                    $data['auction_finish'] = false;
                }
            }
            $data['total_auction'] = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->first()->total_auction;
            return view('pages.home_subkontraktor',$data);
        }else{#JIKA BELUM MASUK KE TENDER LOAD HALAMAN HOME BIASA
            $data['list_pengumuman'] = Pengumuman::with(['listCluster.clusterInfo','listBarang.barangInfo','picInfo'])->orderBy('created_at','desc')->get();
            return view('pages.home',$data);
        }
    }

    public function tentangPage(Request $request)
    {
    	$data['TAG'] = 'tentang';
        $data['captcha_src'] = captcha_src();
    	return view('pages.tentang',$data);
    }

    public function kontakPage(Request $request)
    {
    	$data['TAG'] = 'kontak';
        $data['captcha_src'] = captcha_src();
    	return view('pages.kontak',$data);
    }

    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->route('home');
    }

    // RENEW CAPTCHA
    public function renewCaptcha()
    {
        return response()->json(captcha_src());
    }
    /*
    public function generateCluster(Request $request)
    {
        $cluster = [
            "PIPING, VALVE AND PROPULSI",
            "BOTTOM CLEANING DAN REPLATING",
            "ELECTRIKAL DAN MECANICAL",
            "DT AND NDT",
            "GENERAL SERVICE"
        ];
        foreach ($cluster as $key => $value) {
            Cluster::create([
                'kode'=>$key+1,
                'nama'=>$value
            ]);
        }
    }

    
    public function generateUser(Request $request)
    {
//    	$user = new User();
//    	$user->kode = 'KODE-11';
//    	$user->nama = 'Administrator';
//    	$user->email = 'kurniawan@herobimbel.id';
//    	$user->password = '12345';
//    	$user->telp = '03210987651';
//    	$user->session_id = null;
//    	$user->role = 'admin';
//    	$user->aktif = null;
//    	$user->kadaluarsa = null;
//    	$user->save();

    	for($i=11;$i<=19;$i++){
    		User::create([
    			'kode'=>'KODE-'.$i,
    			'nama'=>'Sub Kontraktor '.$i,
    			'email'=>'kontraktor'.$i.'@herobimbel.id',
    			'password'=>'12345',
    			'telp'=>'03210987782'.$i,
                'bidang_usaha'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
    			'session_id'=>null,
    			'role'=>'subkontraktor',
    			'aktif'=>null,
    			'kadaluarsa'=>null
    		]);
    	}
    }
    */

    public function tesMail(){
        Mail::send('tesmail',array('a'=>'a'), function ($m){
            $m->from(env('MAIL_USERNAME'),"PT.PAL");
            $m->to('pdmojokerto.agung@gmail.com', 'Agung Kurniawan')->subject('Your Reminder!');
        });
    }
}
