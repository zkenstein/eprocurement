<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Auction;
use App\PengumumanUser;
class AuctionController extends Controller
{
	public function addAuction(Request $request)
	{
		$request->merge(array('harga'=>str_replace(["Rp","."," "], "", $request->input('harga'))));
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
}
