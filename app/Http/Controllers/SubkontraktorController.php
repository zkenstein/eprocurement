<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCluster;

class SubkontraktorController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }
    
    public function getData(Request $request,$jenis)
    {	
    	$orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'kode';
            break;
            case "1":
                $orderBy = 'nama';
            break;
            case "2":
                $orderBy = 'email';
            break;
            case "3":
                $orderBy = 'telp';
            case "5":
                $orderBy = 'is_kondite';
                break;
            default:
                $orderBy = 'kode';
            break;
        }

        $subkontraktor = User::with(['listCluster.clusterInfo'])->whereHas('listCluster',function($q1) use($jenis){
            $q1->whereHas('clusterInfo',function($q2)use($jenis){
                $q2->where('jenis',$jenis);
            });
        });

        if($request->input('search.value')!=''){
            $subkontraktor = $subkontraktor
                ->where('nama','like','%'.$request->input('search.value').'%')
                ->orWhere('email','like','%'.$request->input('search.value').'%')
                ->orWhere('telp','like','%'.$request->input('search.value').'%')
                ->orWhere('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('bidang_usaha','like','%'.$request->input('search.value').'%')
                ->orWhereHas('listCluster',function($q1) use($request){
                    $q1->whereHas('clusterInfo',function($q2) use($request){
                        $q2->where('kode','like','%'.$request->input('search.value').'%')
                        ->orWhere('nama','like','%'.$request->input('search.value').'%');
                    });
                });
        }

        $subkontraktor = $subkontraktor->where('role','subkontraktor');

        $recordsFiltered = $subkontraktor->count();

        $subkontraktor = $subkontraktor->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($subkontraktor)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$subkontraktor,
            'request'=>$request->all(),
        ],200);
    }

    public function getSingleData(Request $request, $id)
    {
        $data = User::with('listCluster')->find($id);
        return response()->json(['result'=>true,'data'=>$data]);
    }

    public function addData(Request $request)
    {
        $user = User::create($request->except(['_token','cluster']));
        foreach ($request->input('cluster') as $cluster) {
            UserCluster::create([
                'user_id'=>$user->id,
                'cluster_id'=>$cluster
            ]);
        }
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function editData(Request $request, $id)
    {
        User::where('id',$id)->update($request->except(['_token','_method','cluster']));
        UserCluster::where('user_id',$id)->delete();
        foreach ($request->input('cluster') as $cluster) {
            UserCluster::create([
                'user_id'=>$id,
                'cluster_id'=>$cluster
            ]);
        }
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function deleteData(Request $request, $id)
    {
        User::where('id',$id)->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function setKondite(Request $request, $id){
        $user = User::find($id);
        $kondite = "";
        if($user->is_kondite==0){ $user->is_kondite = 1; $user->save(); $kondite = 1; }
        else{ $user->is_kondite = 0; $user->save(); $kondite = 0; }
        return response()->json(['result'=>true,'token'=>csrf_token(),'kondite'=>$kondite]);
    }
}
