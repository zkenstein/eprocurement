<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Auction;
use App\PengumumanUser;
use App\BarangEksternal;
use App\BarangEksternalUser;
use App\PengumumanBarang;
use App\PengumumanBarangUser;

class AuctionController extends Controller
{
	public function addAuction(Request $request)
	{
		// dd($request->all());
		$total = 0;
		$request->merge(array('harga_barang'=>str_replace(["Rp","."," "], "", $request->input('harga_barang'))));
		$request->merge(array('harga_barang_eksternal'=>str_replace(["Rp","."," "], "", $request->input('harga_barang_eksternal'))));

		foreach ($request->input('harga_barang') as $key => $value) {
			PengumumanBarangUser::where('pengumuman_barang_id',$key)->update(['status'=>0]);
			PengumumanBarangUser::create([
				'pengumuman_barang_id'=>$key,
				'user_id'=>session('id'),
				'harga'=>$value
			]);
			$total+=$value;
		}
		foreach ($request->input('harga_barang_eksternal') as $key => $value) {
			BarangEksternalUser::where('barang_eksternal_id',$key)->update(['status'=>0]);
			BarangEksternalUser::create([
				'barang_eksternal_id'=>$key,
				'user_id'=>session('id'),
				'harga'=>$value
			]);
			$total+=$value;
		}
		Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->update(['status'=>0]);
		Auction::create([
			'pengumuman_id'=>session('pengumuman'),
			'user_id'=>session('id'),
			'total'=>$total
		]);
		PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->update(['total_auction'=>$total]);
		dd($request->all());

		$pengumumanUser = PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->first();
		$total = $pengumumanUser->totalAuction;
		if($total>0){
			$total = 0;
			$auctionInput = array();
			foreach($request->input('harga') as $key=>$harga){
				array_push($auctionInput, new Auction([
					'pengumuman_barang_id'=>$key,
					'user_id'=>session('id'),
					'harga'=>$harga
				]));
				$total+=$harga;
			}
			$checkTotal = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction',$total)->first();
			if($checkTotal!=null){
				
				return response()->json(['result'=>false,'data_prev'=>'']);
			}else{
				foreach($auctionInput as $a) $a->save();
				return response()->json(['result'=>true]);
			}
		}else{
			foreach($request->input('harga') as $key=>$harga){
				Auction::create([
					'pengumuman_barang_id'=>$key,
					'user_id'=>session('id'),
					'harga'=>$harga
				]);
				$total+=$harga;
			}
			$pengumumanUser->update(['total_auction',$total]);
		}
		return response()->json(['result'=>true]);
	}

	public function getDataBarang(Request $request)
	{
		$orderBy = '';
        // switch($request->input('order.0.column')){
        //     case "0":
        //         $orderBy = 'kode';
        //     break;
        //     case "1":
        //         $orderBy = 'deskripsi';
        //     break;
        //     default:
        //         $orderBy = 'kode';
        //     break;
        // }

        $barang = BarangEksternal::where('id','>',0);
        if($request->input('search.value')!=''){
            $barang = $barang
            	->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('deskripsi','like','%'.$request->input('search.value').'%')
                ->orWhere('satuan','like','%'.$request->input('search.value').'%')
                ->orWhere('quantity','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $barang->count();
        $barang = $barang->get();
        // $barang = $barang->skip($request->input('start'))->take($request->input('length'))->get();
        // dd($barang);
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($barang)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$barang
        ],200);
	}
}
