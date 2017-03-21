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
            case "1":
                $orderBy = 'pemesan.username';
            break;
            case "2":
                $orderBy = 'pengirim.username';
            break;
            case "3":
                $orderBy = 'waktu_pemesanan';
            break;
            case "4": 
                $orderBy = 'status';
            break;
        }
        $subkontraktor = user::join('cluster','cluster.id','=','user.cluster_id')->select(['cluster.nama as cluster','user.nama as nama','user.email as email','user.telp as telp'])->where('role','subkontraktor')->get();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>count($subkontraktor)/$request->input('length'),
            'data'=>$subkontraktor,
            'request'=>$request->all()
        ],200);
        $pemesanan = Pemesanan::with(['listItemPesanan.pasarIteminfo.itemInfo.satuanInfo','listItemPesanan.pasarIteminfo.pasarInfo'])->
            join('user as pemesan', 'pemesan.id', '=', 'pemesanan.pemesan_id')
            ->leftJoin('user as pengirim', 'pengirim.id', '=', 'pemesanan.pengirim_id')
            ->select([
                'pemesanan.id',
                'pemesan.nama as nama_pemesan',
                'pemesan.username as username_pemesan',
                'pemesan.nomor_telp as telp_pemesan',
                'pemesan.id as id_pemesan',
                'pengirim.nama as nama_pengirim',
                'pengirim.username as username_pengirim',
                'pengirim.nomor_telp as telp_pengirim',
                'pengirim.id as id_pengirim',
                'pemesanan.total_belanja',
                'pemesanan.biaya_pengiriman',
                'pemesanan.status',
                'pemesanan.created_at as waktu_pemesanan',
                'pemesanan.waktu_pengiriman',
                'pemesanan.alamat_pengiriman'
                ]);

        if($request->input('search.value')!=''){
            $pemesanan = $pemesanan
                ->where(\DB::raw('total_belanja + biaya_pengiriman'),'like','%'.$request->input('search.value').'%')
                ->orWhere('pemesan.nama','like','%'.$request->input('search.value').'%')
                ->orWhere('pengirim.nama','like','%'.$request->input('search.value').'%')
                ->orWhere('pemesanan.status','like','%'.$request->input('search.value').'%')
                ->orWhere('pemesanan.created_at','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $pemesanan->count();

        $pemesanan = $pemesanan->skip($request->input('start'))->take($request->input('length'))->orderBy($orderBy,$request->input('order.0.dir'))->get();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>count($pemesanan)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$pemesanan,
            'request'=>$request->all()
        ]);
        
    }
}
