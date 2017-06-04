<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cluster;

class ClusterController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }
    
    public function getData(Request $request, $jenis)
    {	
    	$orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'kode';
            break;
            case "1":
                $orderBy = 'nama';
            break;
            default:
                $orderBy = 'kode';
            break;
        }

        $cluster = Cluster::where('id','>',0)->where('jenis',$jenis);
        if($request->input('search.value')!=''){
            $cluster = $cluster
            	->where('nama','like','%'.$request->input('search.value').'%')
                ->orWhere('kode','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $cluster->count();

        $cluster = $cluster->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($cluster)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$cluster,
            'request'=>$request->all(),
        ],200);
    }

    public function getSingleData(Request $request, $id)
    {
        $data = Cluster::find($id);
        return response()->json(['result'=>true,'data'=>$data]);
    }

    public function addData(Request $request)
    {
        $cluster = Cluster::create($request->except(['_token']));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function editData(Request $request, $id)
    {
        Cluster::where('id',$id)->update($request->except(['_token','_method']));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function deleteData(Request $request, $id)
    {
        Cluster::where('id',$id)->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function getDataSelect2(Request $request){
//        dd($request->all());
        if($request->input('q')!=''){
            return response()->json(['items'=>Cluster::where('nama','like','%'.$request->input('q').'%')->get()]);
        }else{
            return response()->json(null);
        }
    }
}
