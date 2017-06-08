<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\PengumumanUser;
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
    public function handle()
    {
        $pengumuman = $this->pengumuman;
        PengumumanUser::where('pengumuman_id',$pengumuman->id)->where('total_auction',0)->whereNotNull('waktu_register')->get();

    }
}
