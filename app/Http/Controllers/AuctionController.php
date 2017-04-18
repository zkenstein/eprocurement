<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Auction;

class AuctionController extends Controller
{
	public function addAuction(Request $request)
	{
		dd($request->all());
		// Auction::create([
		// 	'pengumuman_barang_id'=>
		// ]);
	}
}
