<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Barang;

class BarangController extends Controller
{
	public function getData(Request $request)
    {	
    	$orderBy = '';
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'kode';
            break;
            case "1":
                $orderBy = 'deskripsi';
            break;
            default:
                $orderBy = 'kode';
            break;
        }

        $barang = Barang::where('id','>',0);
        if($request->input('search.value')!=''){
            $barang = $barang
            	->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('deskripsi','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $barang->count();

        $barang = $barang->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($barang)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$barang,
            'request'=>$request->all(),
        ],200);
    }

    public function addData(Request $request)
    {
        $gambar = 'default.gif';
        if($request->hasFile('gambar')){
            $gambar = $request->input('kode').'_'.date_format(date_create(),'U').'.'.$request->file('gambar')->getClientOriginalExtension();
            \Storage::disk('public')->put('img/barang/'.$gambar, \File::get($request->file('gambar')));
        }
        $barang = new Barang($request->except(['gambar','_token','_method']));
        $barang->gambar = $gambar;
        $barang->save();
        return response()->json(['result'=>true,'token'=>csrf_token(),'request'=>$request->all()]);
    }

    public function deleteData(Request $request, $id)
    {
        $barang = Barang::find($id);
        if($barang->gambar!="default.gif"){
            \File::delete(public_path('img/barang/'.$barang->gambar));
        }
        $barang->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }
}
