<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengumuman;
use App\PengumumanBarang;
use App\PengumumanCluster;
use App\User;
use App\UserCluster;
use Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\KirimEmailPemberitahuan;
use App\Jobs\InsertPengumumanUser;

class PengumumanController extends Controller
{
    use DispatchesJobs;

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
            case "3":
                $orderBy = 'harga_netto';
            break;
            default:
                $orderBy = 'kode';
            break;
        }
        $pengumuman = Pengumuman::with(['picInfo','listBarang.barangInfo','listCluster.clusterInfo']);

        if($request->input('search.value')!=''){
            $pengumuman = $pengumuman
                ->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_awal_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('batas_akhir_waktu_penawaran','like','%'.$request->input('search.value').'%')
                ->orWhere('validitas_harga','like','%'.$request->input('search.value').'%')
                ->orWhere('waktu_pengiriman','like','%'.$request->input('search.value').'%')
                ->orWhere('harga_netto','like','%'.$request->input('search.value').'%')
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
        // return response()->json($request->all(),500);
        $date = date_format(date_create(),'U');

        // Jika ada sumber data excel
        $excel = null;
        if($request->hasFile('barang_csv')){
            $excel = $request->input('kode').'_'.$date.'.'.$request->file('barang_csv')->getClientOriginalExtension();
            \Storage::disk('local')->put($excel, \File::get($request->file('barang_csv')));
            $request->merge(array('file_excel' => $excel));
        }

        // Edit Request batas waktu penawaran agar bisa masuk database
        $batas_waktu_penawaran = explode(" - ", $request->input('batas_waktu_penawaran'));
        $request->merge(array('batas_awal_waktu_penawaran' => $batas_waktu_penawaran[0].":00"));
        $request->merge(array('batas_akhir_waktu_penawaran' => $batas_waktu_penawaran[1].":00"));
        $request->merge(array('harga_netto'=>str_replace(["Rp","."," "], "", $request->input('harga_netto'))));
        // Jika yang mengumumkan adalah PIC, set PIC sebagai sessionnya
        if(session('role')=='pic') $request->merge(array('pic' => session('id')));
        $pengumuman = Pengumuman::create($request->except(['_token','_method','batas_waktu_penawaran','barang_csv','cluster','barang']));

        // Mulai backgroundprocess insert user + kirim email
        $job = new InsertPengumumanUser($pengumuman,$request->input('cluster'));
        $this->dispatch($job);

        // Insert pengumuman barang
        foreach($request->input('barang') as $barang){
            PengumumanBarang::create(['pengumuman_id'=>$pengumuman->id,'barang_id'=>$barang,'quantity'=>$request->input('quantity.'.$barang)]);
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

}
