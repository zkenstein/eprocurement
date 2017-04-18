<?php

namespace App\Http\Middleware;

use Closure;
use App\Pengumuman;
use App\Auction;

class VerifikasiAuction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pengumuman = Pengumuman::find(session('pengumuman'));
        if($pengumuman!=null){
            if(strtotime($pengumuman->start_auction) < strtotime(\Carbon\Carbon::now()) && strtotime(\Carbon\Carbon::parse($pengumuman->start_auction)->addMinutes($pengumuman->durasi)) > strtotime(\Carbon\Carbon::now()))
                return $next($request);
            return response()->json(['result'=>false,'message'=>'Auction belum dimulai atau sudah selesai']);
        }
        return response()->json(['result'=>false,'message'=>'Anda memasuki tender yang salah, silahkan kembali ke halaman <a href="'.route('home').'">Home</a>']);
    }
}
