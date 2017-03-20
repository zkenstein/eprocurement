<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
