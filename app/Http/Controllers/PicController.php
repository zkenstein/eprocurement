<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class PicController extends Controller
{
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
                $orderBy = 'nama';
            break;
            case "2":
                $orderBy = 'email';
            break;
            case "3":
                $orderBy = 'telp';
            break;
            case "4":
                $orderBy = 'cluster';
            break;
            case "5":
                $orderBy = 'departemen_id';
            break;
            default:
                $orderBy = 'kode';
            break;
        }

        $pic = User::with('departemenInfo')->where('id','<>',0);

        if($request->input('search.value')!=''){
            $cluster = "";
            if($request->input('search.value')=='material'){
                $cluster = "1";
            }else if($request->input('search.value')=='jasa'){
                $cluster = "2";
            }
            $searchRequest = $request->input('search.value');
            $pic = $pic->where(function($query)use($request,$cluster,$searchRequest){
                $query->where('nama','like','%'.$request->input('search.value').'%')
                ->orWhere('email','like','%'.$request->input('search.value').'%')
                ->orWhere('telp','like','%'.$request->input('search.value').'%')
                ->orWhere('cluster','=',$cluster)
                ->orWhereHas('departemenInfo',function($query)use($searchRequest){
                    $query->where('nama','like','%'.$searchRequest.'%');
                })
                ->orWhere('kode','like','%'.$request->input('search.value').'%');
            });
        }

        $pic = $pic->where('role','pic');

        $recordsFiltered = $pic->count();

        $pic = $pic->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($pic)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$pic,
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
        $user = User::create($request->except(['_token','_method']));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function editData(Request $request, $id)
    {
    	$except = ['_token','_method'];
    	if($request->input('password')=='') $except = ['_token','_method','password'];
        User::where('id',$id)->update($request->except($except));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function deleteData(Request $request, $id)
    {
        User::where('id',$id)->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }
}
