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
        $date = date_format(date_create(),'U');
        $excel = null;
        if($request->hasFile('barang_csv')){
            $excel = $request->input('kode').'_'.$date.'.'.$request->file('barang_csv')->getClientOriginalExtension();
            \Storage::disk('local')->put($excel, \File::get($request->file('barang_csv')));
            $request->merge(array('file_excel' => $excel));
        }
        $batas_waktu_penawaran = explode(" - ", $request->input('batas_waktu_penawaran'));
        $request->merge(array('batas_awal_waktu_penawaran' => $batas_waktu_penawaran[0].":00"));
        $request->merge(array('batas_akhir_waktu_penawaran' => $batas_waktu_penawaran[1].":00"));
        if(session('role')=='pic') $request->merge(array('pic' => session('id')));
        $pengumuman = Pengumuman::create($request->except(['_token','_method','batas_waktu_penawaran','barang_csv','cluster','barang']));
        foreach($request->input('barang') as $barang){
            PengumumanBarang::create(['pengumuman_id'=>$pengumuman->id,'barang_id'=>$barang,'quantity'=>$request->input('quantity.'.$barang)]);
        }
        foreach($request->input('cluster') as $cluster){
            $listUser = UserCluster::with('userInfo')->where('cluster_id',$cluster)->get();
            foreach ($listUser as $key => $userCluster) {
                $job = (new KirimEmailPemberitahuan($userCluster->userInfo));
                $this->dispatch($job);
            }
            PengumumanCluster::create(['pengumuman_id'=>$pengumuman->id,'cluster_id'=>$cluster]);
        }
        return response()->json(['result'=>true,'token'=>csrf_token(),'request'=>$request->all()]);
    }

    public function deleteData(Request $request, $id)
    {
        Pengumuman::where('id',$id)->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }
}
