<?php

namespace App\Http\Controllers;

use App\PengumumanUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengumuman;
use App\PengumumanBarang;
use App\PengumumanCluster;
use Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\InsertPengumumanUser;
use App\Jobs\InsertBarangEksternal;

class PengumumanController extends Controller
{
    use DispatchesJobs;
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }

	public function getData(Request $request)
    {	
        
    	$orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'kode';
            break;
            case "1":
                $orderBy = 'batas_awal_waktu_penawaran';
            break;
            case "2":
                $orderBy = 'max_register';
            break;
            /*
            case "3":
                $orderBy = 'harga_netto';
            break;
            */
            default:
                $orderBy = 'kode';
            break;
        }
        $pengumuman = Pengumuman::with(['picInfo','listBarang.barangInfo','listCluster.clusterInfo','pemenangInfo']);

        if($request->input('search.value')!=''){
            $pengumuman = $pengumuman
                ->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_awal_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_akhir_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('validitas_harga','like','%'.$request->input('search.value').'%')
                ->orWhere('waktu_pengiriman','like','%'.$request->input('search.value').'%')
                ->orWhere('nilai_hps','like','%'.$request->input('search.value').'%')
                ->orWhere('mata_uang','like','%'.$request->input('search.value').'%')
                ->orWhere('max_register','like','%'.$request->input('search.value').'%')
                ->orWhereHas('picInfo',function($q) use($request){
                    $q->where('kode','like','%'.$request->input('search.value').'%')
                    ->orWhere('nama','like','%'.$request->input('search.value').'%')
                    ->orWhere('email','like','%'.$request->input('search.value').'%')
                    ->orWhere('telp','like','%'.$request->input('search.value').'%');
                });
        }

        if(session('role')=='pic') $pengumuman = $pengumuman->where('pic',session('id'));

        $recordsFiltered = $pengumuman->count();

        $pengumuman = $pengumuman->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($pengumuman)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$pengumuman,
            'request'=>$request->all(),
        ],200);        
    }

    public function getData2(Request $request)
    {   
        
        $orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'kode';
            break;
            case "1":
                $orderBy = 'batas_awal_waktu_penawaran';
            break;
            case "2":
                $orderBy = 'max_register';
            break;
            /*
            case "3":
                $orderBy = 'nilai_hps';
            break;
            */
            default:
                $orderBy = 'kode';
            break;
        }
        $pengumuman = Pengumuman::with(['picInfo','listBarang.barangInfo','listCluster.clusterInfo','pemenangInfo'])->whereNotNull('pemenang');

        if($request->input('search.value')!=''){
            $pengumuman = $pengumuman
                ->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_awal_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_akhir_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('validitas_harga','like','%'.$request->input('search.value').'%')
                ->orWhere('waktu_pengiriman','like','%'.$request->input('search.value').'%')
                ->orWhere('nilai_hps','like','%'.$request->input('search.value').'%')
                ->orWhere('mata_uang','like','%'.$request->input('search.value').'%')
                ->orWhere('max_register','like','%'.$request->input('search.value').'%')
                ->orWhereHas('picInfo',function($q) use($request){
                    $q->where('kode','like','%'.$request->input('search.value').'%')
                    ->orWhere('nama','like','%'.$request->input('search.value').'%')
                    ->orWhere('email','like','%'.$request->input('search.value').'%')
                    ->orWhere('telp','like','%'.$request->input('search.value').'%');
                });
        }

        if(session('role')=='pic') $pengumuman = $pengumuman->where('pic',session('id'));

        $recordsFiltered = $pengumuman->count();

        $pengumuman = $pengumuman->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>count($pengumuman)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$pengumuman,
            'request'=>$request->all(),
        ],200);        
    }

    public function addData(Request $request)
    {
        // dd($request->all());
        $clusterInput = $request->input('cluster');
        $checkPengumuman = Pengumuman::where('start_auction',$request->input('start_auction'))->whereHas('listCluster',function($q)use($clusterInput){
            $q->whereIn('cluster_id',$clusterInput);
        })->first();
        if($checkPengumuman!=null){
            return response()->json(['result'=>false,'message'=>'Ada pengumuman lelang yang sama dengan waktu auction dan cluster yang sama pada waktu tersebut, silahkan ganti ke jam atau tanggal lain']);
        }
        $lastPengumuman = Pengumuman::orderBy('kode', 'desc')->first();
        $kode = "";
        if($lastPengumuman==null){
                $kode = \Carbon\Carbon::now()->year."0001";
        }else{
            if(substr($lastPengumuman->kode, 0,4)==\Carbon\Carbon::now()->year){
                $kode = (int)$lastPengumuman->kode + 1;
            }else{
                $kode = \Carbon\Carbon::now()->year."0001";
            }
        }
        $request->merge(array('kode' => $kode));
        
        $date = date_format(date_create(),'U');
        // Edit Request batas waktu penawaran agar bisa masuk database
        $batas_waktu_penawaran = explode(" - ", $request->input('batas_waktu_penawaran'));
        $request->merge(array('batas_awal_waktu_penawaran' => $batas_waktu_penawaran[0].":00"));
        $request->merge(array('batas_akhir_waktu_penawaran' => $batas_waktu_penawaran[1].":00"));


        // SETTING HPS
        if($request->input('nilai_hps')=='' || $request->input('nilai_hps')=='Rp. 0'){
            $request->merge(array('nilai_hps'=>'0'));
        } 
        else {
            $request->merge(array('nilai_hps'=>str_replace(["Rp","."," "], "", $request->input('nilai_hps'))));
        }
        // Jika yang mengumumkan adalah PIC, set PIC sebagai sessionnya
        if(session('role')=='pic') $request->merge(array('pic' => session('id')));

        // SET CHECKBOX CC KE KADEP ATAU TIDAK
        if($request->exists('cc_kadep')) $request->merge(array('cc_kadep' => 1));
        else $request->merge(array('cc_kadep' => 0));
        $pengumuman = Pengumuman::create($request->except(['_token','_method','batas_waktu_penawaran','barang_csv','cluster','barang']));
        // Jika ada sumber data excel
        $excel = null;
        if($request->hasFile('barang_csv')){
            $excel = $request->input('kode').'_'.$date.'.'.$request->file('barang_csv')->getClientOriginalExtension();
            $pengumuman->file_excel = $excel;
            $file = \File::get($request->file('barang_csv'));
            \Storage::disk('local')->put($excel, $file);
            $pengumuman->save();
            
            // Mulai backgroundprocess insert barang eksternal
            $job1 = new InsertBarangEksternal($pengumuman->id,$excel);
            $this->dispatch($job1);
        }

        // Mulai backgroundprocess insert user + kirim email
        $job2 = new InsertPengumumanUser($pengumuman,$request->input('cluster'));
        $this->dispatch($job2);

        // cek jika ada inputan barang
        if(count($request->input('barang'))>0){
            // Insert pengumuman barang
            foreach($request->input('barang') as $barang){
                PengumumanBarang::create(['pengumuman_id'=>$pengumuman->id,'barang_id'=>$barang,'quantity'=>$request->input('quantity.'.$barang)]);
            }
        }

        // Insert pengumuman cluster
        foreach($request->input('cluster') as $cluster){
            PengumumanCluster::create(['pengumuman_id'=>$pengumuman->id,'cluster_id'=>$cluster]);
        }

        // Return
        return response()->json(['result'=>true,'token'=>csrf_token(),'request'=>$request->all()]);
    }

    public function deleteData(Request $request, $id)
    {
        // Cek Authority
        if(session('role')=='admin')
            Pengumuman::where('id',$id)->delete();
        else
            Pengumuman::where('id',$id)->where('pic',session('id'))->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function getFileExcel($file_excel)
    {
        $file = \Storage::disk('local')->get($file_excel);
        return response($file, 200);
    }

    public function detailPengumuman(Request $request,$id)
    {
        $pengumuman = Pengumuman::with(['picInfo','listCluster.clusterInfo','listBarang.barangInfo','listUser.userInfo']);
        // Cek Authority
        if(session('role')=='pic') $pengumuman = $pengumuman->where('pic',session('id'));
        $pengumuman = $pengumuman->find($id);
        if($pengumuman!=null) return response()->json(['result'=>true,'data'=>$pengumuman]);
        return response()->json(['result'=>false]);
    }

    public function downloadKontrak(Request $request, $id, $token)
    {
        if(session('role')=='admin'){
            $pengumuman = Pengumuman::find($id);
            return response()->download(storage_path('app/kontrak/kontrak_'.$pengumuman->id.'_'.$pengumuman->pemenang).'.pdf');
        }else if(session('role')=='pic'){
            $pengumuman = Pengumuman::where('pic',session('id'))->where('id',$id)->first();
            if($pengumuman!=null){
                return response()->download(storage_path('app/kontrak/kontrak_'.$pengumuman->id.'_'.$pengumuman->pemenang).'.pdf');
            }
            return response('Anda tidak memiliki akses',403);
        }else{
            $pengumuman = Pengumuman::find($id);
            if($pengumuman!=null){
                if('1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0' == $token){
                    return response()->download(storage_path('app/kontrak/kontrak_'.$pengumuman->id.'_'.$pengumuman->pemenang).'.pdf');
                }
            }
            return response('Anda tidak memiliki akses',403);
        }
    }

    public function downloadBeritaAcara(Request $request, $id)
    {
        $pengumuman = Pengumuman::whereNotNull('pemenang');
        if(session('role')=='pic'){
            $pengumuman = $pengumuman->where('pic',session('id'));
        }
        $pengumuman = $pengumuman->where('id',$id)->first();
        if($pengumuman!=null){
            return response()->download(storage_path('app/berita_acara/berita_acara_'.$pengumuman->id.'_'.$pengumuman->pemenang).'.pdf');
        }
        return response('Anda tidak memiliki akses',403);
    }

    public function getValidUser(Request $request,$id){
        return response()->json(PengumumanUser::with(['userInfo','pengumumanInfo'])->where('pengumuman_id',$id)->where('total_auction','>',0)->get());
    }

}
