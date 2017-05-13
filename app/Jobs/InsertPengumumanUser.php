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
use App\PengumumanUser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\KirimEmailPemberitahuan;

class InsertPengumumanUser extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $pengumuman;
    protected $listIdCluster;
    public function __construct(Pengumuman $pengumuman, $listIdCluster)
    {
        $this->pengumuman = $pengumuman;
        $this->listIdCluster = $listIdCluster;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $listIdCluster = $this->listIdCluster;
        $listUser = User::whereHas('listCluster',function($q) use ($listIdCluster){
            $q->whereIn('cluster_id',$listIdCluster);
        })->distinct()->get();
        foreach($listUser as $user){
            $kode_masuk = substr(md5(uniqid($this->pengumuman->id.'-'.$user->id, true)),5,6);
            PengumumanUser::create([
                'pengumuman_id' => $this->pengumuman->id,
                'user_id' => $user->id,
                'kode_masuk' => $kode_masuk
            ]);
            $file = $this->pengumuman->file_excel;
            $mailer->queue('mail_undangan',['nama_perusahaan'=>$user->nama,'pengumuman'=>$this->pengumuman,'kode_registrasi'=>$kode_masuk],function($message) use ($user, $file){
                $message->to($user->email, $user->nama)->subject("PAL Tender Invitation");
                $message->from(env('MAIL_USERNAME'),"PT.PAL");
                if($file!=null) $message->attach(storage_path('app/'.$file));
            });
        }
    }
}
