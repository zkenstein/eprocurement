<?php

namespace App\Http\Middleware;

use Closure;
use App\PengumumanUser;
class VerifikasiSubkontraktorPengumuman
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
        if(session()->has('pengumuman') && session()->has('id')){
            $pengumumanUser = PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->whereNotNull('waktu_register')->first();
            if($pengumumanUser!=null) 
                return $next($request);
            session()->put('error','Silahkan login terlebih dahulu ke tender yang sesuai');
            return redirect()->route('home');
        }
        session()->put('error','Silahkan login terlebih dahulu ke tender yang sesuai');
        return redirect()->route('home');
    }
}
