<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Pengumuman;
use App\PengumumanUser;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExtendsPengumuman extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $pengumuman;
    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $pengumuman = $this->pengumuman;
        $pengumumanUser = PengumumanUser::with(['userInfo','pengumumanInfo'])->where('pengumuman_id',$pengumuman->id)->get();

        foreach ($pengumumanUser as $pu){
            $isRegistered = "";
            if($pu->waktu_register==null){
                //EMAIL JIKA BELUM MELAKUKAN PENDAFTARAN
                $isRegistered = false;
            }else{
                if($pu->total_auction>0){
                    //Kirim email pemberitahuan ke subkon/vendor yang telah mendaftar bahwa pengumuman diperpanjang.
                    $isRegistered = true;
                }else{
                    //tidak perlu melakukan apa apa, karena Server otomatis melakukan kondite pada subkon/vendor yang telah mendaftar dan tidak mengajukan penawaran
                }
            }
            //Pengiriman email
            $mailer->queue('mail_extends',['pengumuman'=>$pu,'is_registered'=>$isRegistered],function($message) use ($pu){
                $message->to($pu->userInfo->email, $pu->userInfo->nama)->subject("PAL Tender Extends Notification - ".$pu->pengumumanInfo->deskripsi);
                $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
            });
        }

    }
}
