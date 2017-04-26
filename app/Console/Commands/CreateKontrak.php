<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pengumuman;
use App\PengumumanUser;
use \Mail;

class CreateKontrak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:kontrak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $pengumuman = Pengumuman::where('start_auction','<=',\Carbon\Carbon::now())->whereNull('pemenang')->get();
        foreach($pengumuman as $p){
            if(strtotime(\Carbon\Carbon::parse($p->start_auction)->addMinutes($p->durasi)) <= strtotime(\Carbon\Carbon::now())){
                $data = array();
                if($p->pemenang==null){
                    $data['pemenang'] = PengumumanUser::with('userInfo')->whereNotNull('waktu_register')->where('total_auction','>',0)->orderBy('total_auction','asc')->first();
                    $p->pemenang = $data['pemenang']->user_id;
                    $p->save();
                    echo "Pengumuman ".$p->id.' dimenangkan oleh '.$data['pemenang']->user_id;
                }
                $data['pengumuman'] = $p;
                \PDF::loadView('kontrak',$data)->save(storage_path('app/kontrak/kontrak_'.$data['pengumuman']->id.'_'.$data['pemenang']->userInfo->id.'.pdf'));
                echo "\nDokumen kontrak untuk pengumuman ".$p->kode." berhasil dibuat\nmengirim email ke pemenang : ".$data['pemenang']->userInfo->email;
                Mail::send('mail_pemenang', $data, function($message) use($data){
                    $message->to($data['pemenang']->userInfo->email, $data['pemenang']->userInfo->nama)->subject("Pengumuman Hasil Lelang Proyek ".$data['pengumuman']->kode);
                    $message->from(env('MAIL_USERNAME'),"PT.PALL Surabaya");
                });
                echo "Email berhasil dikirim ke ".$data['pemenang']->userInfo->email." Pada ".\Carbon\Carbon::now()."\n";
            }
        }
    }
}
