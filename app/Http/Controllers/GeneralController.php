<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Mail;
use App\User;
use App\Cluster;
use App\Barang;
use App\Pengumuman;

class GeneralController extends Controller
{

    public function invite()
    {
        $data = array('name'=>"Our Code World");
        $template_path = 'mail_undangan';

        Mail::send($template_path, $data, function($message) {
            $message->to("upload.kurniawan@gmail.com", "Agung")->subject("tes");
            $message->from(env('MAIL_USERNAME'),"tes");
        });

        return "Basic email sent, check your inbox.";
    }

    public function berandaPage(Request $request)
    {
        // dd(PHP_OS);
    	$data['TAG'] = 'beranda';
        $data['count_subkontraktor'] = User::where('role','subkontraktor')->count();
        $data['count_cluster'] = Cluster::count();
        $data['count_barang'] = Barang::count();
        $data['count_pengumuman'] = Pengumuman::count();
    	return view('pages.beranda',$data);
    }

    public function subkontraktorPage(Request $request)
    {
    	$data['TAG'] = 'subkontraktor';
        $data['list_cluster'] = Cluster::all();
    	return view('pages.subkontraktor',$data);
    }

    public function picPage(Request $request)
    {
        $data['TAG'] = 'pic';
        return view('pages.pic',$data);
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
        $data['list_cluster'] = Cluster::all();
        $data['list_barang'] = Barang::all();
        $data['list_pic'] = User::where('role','pic')->get();
    	return view('pages.pengumuman',$data);
    }

    public function validateInput(Request $request, $name)
    {
        $this->validate($request,[
            $name=>$request->input('_rule')
        ]);
    }
}
