<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Mail;
use App\User;

class GeneralController extends Controller
{

    private function invite($to,$name,$subject)
    {
        $data = array('name'=>"Our Code World");
        $template_path = 'mail_undangan';

        Mail::send($template_path, $data, function($message) {
            $message->to($to, $name)->subject($subject);
            $message->from(env('MAIL_USERNAME'),$subject);
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
