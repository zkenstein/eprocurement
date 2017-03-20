<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Mail;

class GeneralController extends Controller
{

    // public function homePage(Request $request)
    // {
    // 	$data['TAG'] = 'beranda';
    // 	return view('pages.beranda',$data);
    // }

    public function berandaPage(Request $request)
    {
    	$data['TAG'] = 'beranda';
    	return view('pages.beranda',$data);
    }

    public function subkontraktorPage(Request $request)
    {
    	$data['TAG'] = 'subkontraktor';
    	return view('pages.subkontraktor',$data);
    }

    public function clusterPage(Request $request)
    {
    	$data['TAG'] = 'cluster';
    	return view('pages.cluster',$data);
    }

    public function barangPage(Request $request)
    {
    	$data['TAG'] = 'barang';
    	return view('pages.barang',$data);
    }

    public function pengumumanPage(Request $request)
    {
    	$data['TAG'] = 'pengumuman';
    	return view('pages.pengumuman',$data);
    }
}
