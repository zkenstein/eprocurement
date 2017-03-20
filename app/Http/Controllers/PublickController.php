<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Cluster;

class PublickController extends Controller
{
    public function loginPage(Request $request)
    {
    	return view('login');
    }

    public function homePage(Request $request)
    {
    	$data['TAG'] = 'home';
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

    public function generateCluster(Request $request)
    {
    	for($i=0;$i<5;$i++){
    		$cluster = new Cluster();
    		$cluster->kode = 'KODE '.$i;
    		$cluster->nama = 'CLUSTER '.$i;
    		$cluster->save();
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
    	$user->aktif = \Carbon\Carbon::now();
    	$user->kadaluarsa = \Carbon\Carbon::now()->addDay(2);
    	$user->save();

    	$listCluster = collect(Cluster::select('id')->get())->toArray();

    	foreach ($listCluster as $key => $value) {
    		$listCluster[$key] = $value['id'];
    	}

		// dd($listCluster[array_rand($listCluster)]);

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
    			'kadaluarsa'=>null,
    			'cluster_id'=>$listCluster[array_rand($listCluster)]
    		]);
    	}
    }
}
