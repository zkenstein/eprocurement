<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCluster;

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

        $subkontraktor = User::with(['listCluster']);

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
}
