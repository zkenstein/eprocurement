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
        if($user!=null){
            $user = PengumumanUser::whereHas('pengumumanInfo',function($q) use($pengumuman){
                $q->where('batas_akhir_waktu_penawaran','>',\Carbon\Carbon::now());
            })->where('user_id',$user->id)->where('kode_masuk',$kodeMasuk)->where('pengumuman_id',$pengumuman)->first();
            if($user!=null){

            }else{

            }
        }else{

        }
    }

    public function homePage(Request $request)
    {
    	$data['TAG'] = 'home';
        $data['list_pengumuman'] = Pengumuman::with(['listCluster.clusterInfo','listBarang.barangInfo'])->where('batas_akhir_waktu_penawaran','>=',\Carbon\Carbon::now())->orderBy('created_at','desc')->get();
    	return view('pages.home',$data);
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
    */
    
    public function generateUser(Request $request)
    {
    	// $user = new User();
    	// $user->kode = 'KODE-0';
    	// $user->nama = 'Administrator';
    	// $user->email = 'kurniawan@herobimbel.id';
    	// $user->password = '12345';
    	// $user->telp = '03210987651';
    	// $user->session_id = null;
    	// $user->role = 'admin';
    	// $user->aktif = null;
    	// $user->kadaluarsa = null;
    	// $user->save();
    /*
        $subkontraktor = [
            
        ];

    	$listCluster = collect(Cluster::select('id')->get())->toArray();

    	foreach ($listCluster as $key => $value) {
    		$listCluster[$key] = $value['id'];
    	}

        $rand_keys = array_rand($listCluster, rand(1,5));

        foreach ($rand_keys as $r) {
            
        }

    	for($i=1;$i<=10;$i++){
    		User::create([
    			'kode'=>'KODE-'.$i,
    			'nama'=>'Sub Kontraktor '.$i,
    			'email'=>'kontraktor'.$i.'@herobimbel.id',
    			'password'=>null,
    			'telp'=>'03210987782'.$i,
    			'session_id'=>null,
    			'role'=>'subkontraktor',
    			'aktif'=>null,
    			'kadaluarsa'=>null
    			// 'cluster_id'=>$listCluster[array_rand($listCluster)]
    		]);
    	}
    */
    }
    
}
