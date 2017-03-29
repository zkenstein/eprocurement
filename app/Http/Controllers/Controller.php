<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Http\Request;
// use App\Jobs\KirimEmailPemberitahuan;
// use App\User;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function kirimEmailPemberitahuan(Request $request,User $user)
    // {
    //     $this->dispatch(new KirimEmailPemberitahuan($user));
    // }
}
