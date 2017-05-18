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
use App\PengumumanUser;
use App\PengumumanBarang;
use App\BarangEksternal;

class GeneralController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }

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
    	$data['title'] = 'Subkontraktor';
        $data['jenis'] = 'jasa';
        $data['list_cluster'] = Cluster::where('jenis','jasa')->get();
    	return view('pages.subkontraktor',$data);
    }

    public function vendorPage(Request $request)
    {
        $data['TAG'] = 'vendor';
        $data['title'] = 'Vendor';
        $data['jenis'] = 'barang';
        $data['list_cluster'] = Cluster::where('jenis','barang')->get();
        return view('pages.subkontraktor',$data);
    }

    public function picPage(Request $request)
    {
        $data['TAG'] = 'pic';
        return view('pages.pic',$data);
    }

    public function clusterBarangPage(Request $request)
    {
    	$data['TAG'] = 'cluster_barang';
        $data['jenis'] = 'barang';
    	return view('pages.cluster',$data);
    }
    public function clusterJasaPage(Request $request)
    {
        $data['TAG'] = 'cluster_jasa';
        $data['jenis'] = 'jasa';
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

    public function monitoringPage(Request $request)
    {
        $data['TAG'] = 'monitoring';
        $data['list_pengumuman'] = Pengumuman::with(['picInfo','listUser.userInfo','listCluster'])->where('batas_awal_waktu_penawaran','<=',\Carbon\Carbon::now())->whereRaw('DATE_ADD(start_auction,INTERVAL durasi MINUTE) > NOW()');
        $data['list_pic'] = User::where('role','pic')->get();
        if(session('role')=='pic'){
            $data['list_pengumuman'] = $data['list_pengumuman']->where('pic',session('id'));
        }
        $data['list_pengumuman'] = $data['list_pengumuman']->get();
        return view('pages.monitoring',$data);
    }

    public function liveAuctionPage(Request $request,$id)
    {
        $data['TAG'] = 'monitoring';
        $data['pengumuman'] = Pengumuman::with('listUser.userInfo')->find($id);
        return view('pages.live_auction',$data);
    }

    public function detailPengumumanPage(Request $request,$kode)
    {
        $data['TAG'] = 'monitoring';
        $data['pengumuman'] = Pengumuman::with(['picInfo'])->where('kode',$kode)->first();
    }

    public function validateInput(Request $request, $name)
    {
        $this->validate($request,[
            $name=>$request->input('_rule')
        ]);
    }

    public function auctionPage(Request $request)
    {
        $allowAccessAuction = false;
        $data['pengumuman'] = Pengumuman::find(session('pengumuman'));
        $startAuction = strtotime($data['pengumuman']->start_auction);
        $stopAuction = strtotime(\Carbon\Carbon::parse($data['pengumuman']->start_auction)->addMinutes($data['pengumuman']->durasi));

        if($stopAuction >= strtotime(\Carbon\Carbon::now()) && $startAuction <= strtotime(\Carbon\Carbon::now())) $allowAccessAuction = true;
        
        // JIKA AUCTION SUDAH DIBUKA DAN BELUM DITUTUP
        if($allowAccessAuction){
            // UNTUK MENAMPILKAN COUNTDOWN SAAT AUCTION
            $data['auctionNow'] = true;

            $data['total_auction'] = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->first()->total_auction;
            $data['TAG'] = 'auction';
            // MENGAMBIL DATA LIST BARANG INTERNAL YANG DILELANG DAN PENAWARAN USER SEBELUMNYA
            $data['list_barang'] = PengumumanBarang::with(['barangInfo','inUserAuction'])->where('pengumuman_id',session('pengumuman'))->get();
            // MENGAMBIL DATA LIST BARANG EKSTERNAL YANG DILELANG DAN PENAWARAN USER SEBELUMNYA
            $data['list_barang_eksternal'] = BarangEksternal::with('inUserAuction')->where('pengumuman_id',session('pengumuman'))->get();
            // COUNTDOWN WAKTU TERSISA
            $data['countdown'] = 
            \Carbon\Carbon::parse($data['pengumuman']->start_auction)
            ->addMinutes($data['pengumuman']->durasi)->
            addSeconds(-1)->//TOLERANSI WAKTU TRANSFER DATA KE CLIENT . WAKTU AUCTION AKAN 1 DETIK LEBIH CEPAT DIBANDING ASLINYA
            diffInSeconds(\Carbon\Carbon::now());

            return view('pages.auction',$data);
        }

        // JIKA AUCTION BELUM DIBUKA ATAU SUDAH DITUTUP
        session()->put("error","Auction belum dimulai atau sudah selesai dilakukan");
        return redirect()->route("home");
    }

    public function arsipPage(Request $request)
    {
        $data['TAG'] = 'arsip';
        return view('pages.arsip',$data);
    }
}
