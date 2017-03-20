<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Mail;

class GeneralController extends Controller
{

    public function htmlmail()
    {
        $data = array('name'=>"Our Code World");
        // Path or name to the blade template to be rendered
        $template_path = 'mail_undangan';

        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('kontraktor1@herobimbel.id', 'Kontraktor 1')->subject('Laravel HTML Mail');
            // Set the sender
            $message->from('kurniawan@herobimbel.id','Our Code World');
        });

        return "Basic email sent, check your inbox.";
    }

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
