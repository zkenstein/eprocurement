<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pengumuman;

class CreateBeritaAcara extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:berita_acara';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat berita acara';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $data = ['pengumuman'] = App\Pengumuman::find(4);
        // $data['pemenang'] = App\PengumumanUser::where('user_id',8)->where('pengumuman_id',4)->first();
        $createKontrak = \PDF::loadView('kontrak',array())->save(storage_path('app/kontrak/kontrak.pdf'));
        /*
        $createBeritaAcara = \PDF::loadView('berita_acara',array())->setPaper('folio','potrait')->save(storage_path('app/berita_acara/berita_acara.pdf'));
        if($createBeritaAcara) $this->info("Berita acara telah dibuat [".\Carbon\Carbon::now()."]");
        */
    }
}
