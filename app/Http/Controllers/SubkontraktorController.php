<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class SubkontraktorController extends Controller
{
    public function getData(Request $request)
    {	
    	$orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'user.nama';
            break;
            case "1":
                $orderBy = 'user.email';
            break;
            case "2":
                $orderBy = 'user.telp';
            break;
            case "3":
                $orderBy = 'cluster.nama';
            break;
        }

        $subkontraktor = user::leftJoin('cluster','cluster.id','=','user.cluster_id')->select(['cluster.kode as cluster_kode','cluster.nama as cluster','user.nama as nama','user.email as email','user.telp as telp']);

        if($request->input('search.value')!=''){
            $subkontraktor = $subkontraktor
                ->where('user.nama','like','%'.$request->input('search.value').'%')
                ->orWhere('user.email','like','%'.$request->input('search.value').'%')
                ->orWhere('user.telp','like','%'.$request->input('search.value').'%')
                ->orWhere('cluster.nama','like','%'.$request->input('search.value').'%')
                ->orWhere('cluster.kode','like','%'.$request->input('search.value').'%');
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
}
