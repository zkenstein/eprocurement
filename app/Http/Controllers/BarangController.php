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

    public function getSingleData(Request $request, $id)
    {
        $data = Barang::find($id);
        return response()->json(['result'=>true,'data'=>$data]);
    }

    public function addData(Request $request)
    {
        $gambar = 'default.gif';
        $pdf = null;
        $date = date_format(date_create(),'U');
        if($request->hasFile('gambar')){
            $gambar = $request->input('kode').'_'.$date.'.'.$request->file('gambar')->getClientOriginalExtension();
            \Storage::disk('public')->put('img/barang/'.$gambar, \File::get($request->file('gambar')));
        }
        if($request->hasFile('pdf')){
            $pdf = $request->input('kode').'_'.$date.'.'.$request->file('pdf')->getClientOriginalExtension();
            \Storage::disk('public')->put('img/barang/'.$pdf, \File::get($request->file('pdf')));
        }
        $barang = new Barang($request->except(['gambar','pdf','_token','_method']));
        $barang->gambar = $gambar;
        $barang->pdf = $pdf;
        $barang->save();
        return response()->json(['result'=>true,'token'=>csrf_token(),'request'=>$request->all()]);
    }

    public function deleteData(Request $request, $id)
    {
        $barang = Barang::find($id);
        if($barang->gambar!="default.gif"){
            \File::delete(public_path('img/barang/'.$barang->gambar));
        }
        if($barang->pdf!=null){
            \File::delete(public_path('img/barang/'.$barang->pdf));
        }
        $barang->delete();
        return response()->json(['result'=>true,'token'=>csrf_token()]);
    }

    public function removeGambar(Request $request, $id)
    {
        $barang = Barang::find($id);
        if($barang->gambar!='default.gif'){
            \File::delete(public_path('/img/barang/'.$barang->gambar));
        }
        $barang->gambar = 'default.gif';
        $barang->save();
        return response()->json(['result'=>true]);
    }

    public function removePdf(Request $request, $id)
    {
        $barang = Barang::find($id);
        if($barang->pdf!=null){
            \File::delete(public_path('/img/barang/'.$barang->pdf));
        }
        $barang->pdf = null;
        $barang->save();
        return response()->json(['result'=>true]);
    }

    public function editData(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->kode = $request->input('kode');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->satuan = $request->input('satuan');
        $gambar = 'default.gif';
        $pdf = null;
        $date = date_format(date_create(),'U');
        if($request->hasFile('gambar')){
            if($barang->gambar!='default.gif'){
                \File::delete(public_path('/img/barang/'.$barang->gambar));
                $gambar = $request->input('kode').'_'.$date.'.'.$request->file('gambar')->getClientOriginalExtension();
                \Storage::disk('public')->put('img/barang/'.$gambar, \File::get($request->file('gambar')));
            }else{
                $gambar = $request->input('kode').'_'.$date.'.'.$request->file('gambar')->getClientOriginalExtension();
                \Storage::disk('public')->put('img/barang/'.$gambar, \File::get($request->file('gambar')));
            }
            $barang->gambar = $gambar;
        }
        if($request->hasFile('pdf')){
            if($barang->pdf!=null){
                \File::delete(public_path('/img/barang/'.$barang->pdf));
                $pdf = $request->input('kode').'_'.$date.'.'.$request->file('pdf')->getClientOriginalExtension();
                \Storage::disk('public')->put('img/barang/'.$pdf, \File::get($request->file('pdf')));
            }else{
                $pdf = $request->input('kode').'_'.$date.'.'.$request->file('pdf')->getClientOriginalExtension();
                \Storage::disk('public')->put('img/barang/'.$pdf, \File::get($request->file('pdf')));
            }
            $barang->pdf = $pdf;
        }
        $barang->save();
        return response()->json(['result'=>true,'token'=>csrf_token(),'request'=>$request->all()]);
    }
}
