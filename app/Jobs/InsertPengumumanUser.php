<?php

namespace App\Jobs;

use App\Jobs\Job;
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
    public function handle()
    {
        $listIdCluster = $this->listIdCluster;
        $listUser = User::whereHas('listCluster',function($q) use ($listIdCluster){
            $q->whereIn('cluster_id',$listIdCluster);
        })->distinct()->get();
        foreach($listUser as $user){
            $kode_masuk = md5(uniqid($this->pengumuman->id.'-'.$user->id, true));
            PengumumanUser::create([
                'pengumuman_id' => $this->pengumuman->id,
                'user_id' => $user->id,
                'kode_masuk' => $kode_masuk
            ]);
            $job = (new KirimEmailPemberitahuan($this->pengumuman,$user,$kode_masuk));
            $this->dispatch($job);
        }
    }
}
