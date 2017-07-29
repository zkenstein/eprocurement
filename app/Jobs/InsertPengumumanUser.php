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
use App\PengumumanBarang;
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
        $listUser = User::with('departemenInfo')->where('is_kondite',0)->whereHas('listCluster',function($q) use ($listIdCluster){
            $q->whereIn('cluster_id',$listIdCluster);
        })->distinct()->get();
        $pengumuman = $this->pengumuman;
        $listBarang = PengumumanBarang::with('barangInfo')->where('pengumuman_id',$pengumuman->id)->get();
        $file = $pengumuman->file_excel;

        if($pengumuman->cc_kadep==1){#JIKA MENGIRIM CARBON COPY KE KADEP
            $mailer->queue('mail_undangan',['departemen_id'=>$pengumuman->picInfo->departemenInfo->id,'nama_perusahaan'=>'Nama Perusahaan','pengumuman'=>$pengumuman,'kode_registrasi'=>'kode masuk','departemen'=>$pengumuman->picInfo->departemenInfo,'list_barang'=>$listBarang],function($message) use ($file, $pengumuman){
                $message->to($pengumuman->picInfo->email, $pengumuman->picInfo->departemenInfo->nama)->cc($pengumuman->picInfo->departemenInfo->email_kadep)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                if($file!=null) 
                    $message->attach(storage_path('app/'.$pengumuman->kode.'.pdf'));
                    // $message->attach(storage_path('app/'.$file));
            });
        }else{#JIKA TIDAK MENGIRIM CARBON COPY
            $mailer->queue('mail_undangan',['departemen_id'=>$pengumuman->picInfo->departemenInfo->id,'nama_perusahaan'=>'Nama Perusahaan','pengumuman'=>$pengumuman,'kode_registrasi'=>'kode masuk','departemen'=>$pengumuman->picInfo->departemenInfo,'list_barang'=>$listBarang],function($message) use ($file, $pengumuman){
                $message->to($pengumuman->picInfo->email, $pengumuman->picInfo->departemenInfo->nama)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                if($file!=null) 
                    $message->attach(storage_path('app/'.$pengumuman->kode.'.pdf'));
                    // $message->attach(storage_path('app/'.$file));
            });
        }
        
        foreach($listUser as $user){
            $pengumumanUser = PengumumanUser::where('user_id',$user->id)->where('pengumuman_id',$pengumuman->id)->first();
            if($pengumumanUser==null){
                $kode_masuk = substr(md5(uniqid($pengumuman->id.'-'.$user->id, true)),5,6);#GEnERATE KODE MASUK PENGUMUMAN 6 KARAKTER
                
                $mailer->queue('mail_undangan',['departemen_id'=>$pengumuman->picInfo->departemenInfo->id,'nama_perusahaan'=>$user->nama,'pengumuman'=>$pengumuman,'kode_registrasi'=>$kode_masuk,'departemen'=>$pengumuman->picInfo->departemenInfo,'list_barang'=>$listBarang],function($message) use ($user, $file, $pengumuman){
                    $message->to($user->email, $user->nama)->subject("PAL Tender Invitation - ".$pengumuman->deskripsi);
                    $message->from(env('MAIL_USERNAME'),"PT. PAL Indonesia (Persero)");
                    if($file!=null) 
                        $message->attach(storage_path('app/'.$pengumuman->kode.'.pdf'));
                        // $message->attach(storage_path('app/'.$file));
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
