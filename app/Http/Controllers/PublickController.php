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
use Mail;

class PublickController extends Controller
{
    // Cek login umum
	public function loginCheck(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$user = User::where(['email'=>$email,'password'=>$password])->first();
		if($user!=null){
            session()->put('role',$user->role);
            session()->put('id',$user->id);
            session()->put('nama',$user->nama);
			return response()->json(['data'=>$user,'result'=>true]);
		}
		return response()->json(['result'=>false,'message'=>'not match']);
	}

    // Cek subkontraktor yg terdaftar
    public function registerCheck(Request $request)
    {
        $email = $request->input('email');
        $kodeMasuk = $request->input('kode_masuk');
        $pengumuman = $request->input('pengumuman');
        $user = User::where('email',$email)->first();
        if($user!=null){#Jika user ditemukan
            $userPengumuman = PengumumanUser::whereHas('pengumumanInfo',function($q) use($pengumuman){
                $q->where('batas_akhir_waktu_penawaran','>',\Carbon\Carbon::now());
            })->where('user_id',$user->id)->where('kode_masuk',$kodeMasuk)->where('pengumuman_id',$pengumuman)->first();#BAHAYA, MUNGKIN BISA JADI BUG
            if($userPengumuman!=null){#Jika user terdaftar dalam calon pelelang
                $pengumuman = Pengumuman::find($pengumuman);
                if($pengumuman->pemenang!=null){#Jika sudah ada pengumuman pemenang
                    if($userPengumuman->waktu_register!=null){#Jika user pernah login sebelumnya
                        session()->put('pengumuman',$pengumuman->id);
                        session()->put('mode','lihat');
                        session()->put('role',$user->role);
                        session()->put('id',$user->id);
                        session()->put('nama',$user->nama);
                        return response()->json(['result'=>true],200);
                    }
                    return response()->json(['result'=>false,'message'=>'Anda tidak mengikuti lelang ini']);
                }else{#Jika belum ada pengumuman pemenang
                    if($pengumuman->max_register==0 || $pengumuman->max_register > $pengumuman->count_register){#Jika max register = tidak dibatasi atau jika max register dibatasi tapi belum penuh
                        if($userPengumuman->waktu_register==null){#Jika user belum pernah login sebelumnya
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
                        }
                        session()->put('pengumuman',$pengumuman->id);
                        session()->put('mode','login');
                        session()->put('role',$user->role);
                        session()->put('id',$user->id);
                        session()->put('nama',$user->nama);
                        return response()->json(['result'=>true],200);
                    }else{#jika max_register dibatasi dan sudah penuh
                        if($userPengumuman->waktu_register==null){#Jika user belum pernah login sebelumnya
                            return response()->json(['result'=>false,'message'=>'Pendaftar sudah pernuh, anda tidak dapat mendaftar untuk lelang ini']);
                        }
                        #Jika sudah pernah daftar
                        session()->put('pengumuman',$pengumuman->id);
                        session()->put('mode','login');
                        session()->put('role',$user->role);
                        session()->put('id',$user->id);
                        session()->put('nama',$user->nama);
                        return response()->json(['result'=>true],200);
                    }
                }
            }
            #Jika user tidak seharusnya mendaftar
            return response()->json(['result'=>false,'message'=>'Email anda tidak terdaftar pada tender ini']);
        }
        #Jika user tidak ditemukan
        return response()->json(['result'=>false,'message'=>'Email tidak terdaftar dalam subkontraktor PT.PAL']);
    }

    public function homePage(Request $request)
    {
        // if(session('role')=='subkontraktor') dd(session()->all());
    	$data['TAG'] = 'home';
        if(session('mode')=='login'){
            $data['pengumuman'] = Pengumuman::with(['listCluster.clusterInfo','listBarang.barangInfo'])->find(session('pengumuman'));
            return view('pages.home_subkontraktor',$data);
        }else{
            $data['list_pengumuman'] = Pengumuman::with(['listCluster.clusterInfo','listBarang.barangInfo'])->orderBy('created_at','desc')->get();
            return view('pages.home',$data);
        }
    }

    public function tentangPage(Request $request)
    {
    	$data['TAG'] = 'tentang';
    	return view('pages.tentang',$data);
    }

    public function kontakPage(Request $request)
    {
    	$data['TAG'] = 'kontak';
    	return view('pages.kontak',$data);
    }

    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->route('home');
    }

    
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
    	$user = new User();
    	$user->kode = 'KODE-0';
    	$user->nama = 'Administrator';
    	$user->email = 'kurniawan@herobimbel.id';
    	$user->password = '12345';
    	$user->telp = '03210987651';
    	$user->session_id = null;
    	$user->role = 'admin';
    	$user->aktif = null;
    	$user->kadaluarsa = null;
    	$user->save();

    	for($i=1;$i<=10;$i++){
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
    
}
