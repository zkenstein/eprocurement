<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Pengumuman;

class KirimEmailPemberitahuan extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $pengumuman;
    protected $subkontraktor;
    protected $kodeRegistrasi;

    public function __construct(Pengumuman $pengumuman, User $subkontraktor, $kodeRegistrasi)
    {
        $this->pengumuman = $pengumuman;
        $this->subkontraktor = $subkontraktor;
        $this->kodeRegistrasi = $kodeRegistrasi;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $user = $this->subkontraktor;
        $file = $this->pengumuman->file_excel;
        $mailer->queue('mail_undangan',['nama_perusahaan'=>$user->nama,'pengumuman'=>$this->pengumuman,'kode_registrasi'=>$this->kodeRegistrasi],function($message) use ($user, $file){
            $message->to($user->email, $user->nama)->subject("PAL Tender Invitation");
            $message->from(env('MAIL_USERNAME'),"PT.PAL");
            if($file!=null) $message->attach(storage_path('app/'.$file));
        });
    }
}
