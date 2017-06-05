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
        $listUser = User::with('departemenInfo')->whereHas('listCluster',function($q) use ($listIdCluster){
            $q->whereIn('cluster_id',$listIdCluster);
        })->distinct()->get();
        $pengumuman = $this->pengumuman;
        $file = $pengumuman->file_excel;
        // $pic = User::with('departemenInfo')->where('id',$pengumuman->pic)->first();
        // $departemen = $pic->$departemenInfo();
        if($pengumuman->cc_kadep==1){
            $mailer->send('mail_undangan',['departemen_id'=>$pengumuman->picInfo->departemenInfo->id,'nama_perusahaan'=>'Nama Perusahaan','pengumuman'=>$pengumuman,'kode_registrasi'=>'kode masuk','departemen'=>$pengumuman->picInfo->departemenInfo],function($message) use ($file, $pengumuman){
                $message->to($pengumuman->picInfo->email, $pengumuman->picInfo->departemenInfo->nama)->cc($pengumuman->picInfo->departemenInfo->email_kadep)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                if($file!=null) $message->attach(storage_path('app/'.$file));
            });
        }else{
            $mailer->send('mail_undangan',['departemen_id'=>$pengumuman->picInfo->departemenInfo->id,'nama_perusahaan'=>'Nama Perusahaan','pengumuman'=>$pengumuman,'kode_registrasi'=>'kode masuk','departemen'=>$pengumuman->picInfo->departemenInfo],function($message) use ($file, $pengumuman){
                $message->to($pengumuman->picInfo->email, $pengumuman->picInfo->departemenInfo->nama)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                if($file!=null) $message->attach(storage_path('app/'.$file));
            });
        }
        foreach($listUser as $user){
            $pengumumanUser = PengumumanUser::where('user_id',$user->id)->where('pengumuman_id',$pengumuman->id)->first();
            if($pengumumanUser==null){
                $kode_masuk = substr(md5(uniqid($pengumuman->id.'-'.$user->id, true)),5,6);
                $mailer->queue('mail_undangan',['departemen_id'=>$user->departemen_id,'nama_perusahaan'=>$user->nama,'pengumuman'=>$this->pengumuman,'kode_registrasi'=>$kode_masuk,'departemen'=>$pengumuman->picInfo->departemenInfo],function($message) use ($user, $file, $pengumuman){
                    $message->to($user->email, $user->nama)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                    $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                    if($file!=null) $message->attach(storage_path('app/'.$file));
                });
                PengumumanUser::create([
                    'pengumuman_id' => $pengumuman->id,
                    'user_id' => $user->id,
                    'kode_masuk' => $kode_masuk
                ]);
            }
        }
    }
}
