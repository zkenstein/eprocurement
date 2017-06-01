<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Departemen;

class DepartemenController extends Controller
{
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
                $orderBy = 'kadep';
            break;
            case "3":
                $orderBy = 'email_kadep';
            break;
            default:
                $orderBy = 'kode';
            break;
        }

        $departemen = Departemen::where('id','>',0);
        if($request->input('search.value')!=''){
            $departemen = $departemen
                ->where('nama','like','%'.$request->input('search.value').'%')
                ->orWhere('kode','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $departemen->count();

        $departemen = $departemen->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>count($departemen)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$departemen,
            'request'=>$request->all(),
        ],200);
    }

    public function getSingleData(Request $request, $id)
    {
        $data = Departemen::find($id);
        return response()->json(['result'=>true,'data'=>$data]);
    }

    public function addData(Request $request)
    {
        $departemen = Departemen::create($request->except(['_token']));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function editData(Request $request, $id)
    {
        Departemen::where('id',$id)->update($request->except(['_token','_method']));
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function deleteData(Request $request, $id)
    {
        Departemen::where('id',$id)->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }
}
