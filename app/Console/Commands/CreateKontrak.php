<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pengumuman;
use App\PengumumanUser;
use App\BarangEksternal;
use App\BarangEksternalUser;
use App\User;
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
        $this->info("Cek pemenang [".\Carbon\Carbon::now()."]");
        $pengumuman = Pengumuman::with(['listAuction.userInfo','listRegisteredUser.userInfo'])->has('listValidUser','>','1')->where('start_auction','<=',\Carbon\Carbon::now())->whereNull('pemenang')->get();
        
        if(count($pengumuman)>0){
            foreach($pengumuman as $p){
                if(strtotime(\Carbon\Carbon::parse($p->start_auction)->addMinutes($p->durasi)) <= strtotime(\Carbon\Carbon::now())){
                    if($p->jenis=='itemize'){#JIKA ITEMIZE
                        $this->info('Pengumuman Itemize ['.\Carbon\Carbon::now().']');
                        $pemenang = User::with(['listBarangEksternalAuction'=>function($q)use($p){
                            $q->with('barangEksternalInfo')->where('is_win',1)->whereHas('barangEksternalInfo',function($q2)use($p){
                                $q2->where('pengumuman_id',$p->id);
                            });
                        }])->whereHas('listBarangEksternalAuction',function($q)use($p){
                            $q->wherehas('barangEksternalInfo',function($q2)use($p){
                                $q2->where('pengumuman_id',$p->id);
                            })->where('status',1)->where('is_win',1);
                        })->get();
                        $this->info('Jumlah pemenang : '.count($pemenang).' ['.\Carbon\Carbon::now().']');

                        if(count($pemenang)>0){
                            $this->info('ditemukan '.count($pemenang).' pemenang ['.\Carbon\Carbon::now().']');
                            $listBarangEksternalAuction = BarangEksternalUser::with(['userInfo','barangEksternalInfo'])->whereHas('barangEksternalInfo',function($q)use($p){
                                $q->where('pengumuman_id',$p->id);
                            })->get();
                            $data['list_barang_eksternal_auction'] = $listBarangEksternalAuction;
                            $data['pengumuman'] = $p;
                            $data['para_pemenang'] = $pemenang;
                            $this->info("Membuat berita acara [".\Carbon\Carbon::now()."]");
                            $createBeritaAcara  = \PDF::loadView('berita_acara',$data)->setPaper('folio','potrait')->save(storage_path('app/berita_acara/berita_acara_'.$p->id.'.pdf'));

                            foreach ($pemenang as $pem) {
                                $this->info('mengirim email ke pemenang : '.$pem->email.' ['.\Carbon\Carbon::now().']');
                                $data['pemenang'] = $pem;
                                Mail::queue('mail_pemenang', $data, function($message) use($pem,$p){
                                    $message->to($pem->email, $pem->nama)->subject("Pengumuman Hasil Lelang Proyek ".$p->kode);
                                    $message->from(env('MAIL_USERNAME'),"PT.PALL Indonesia (Persero)");
                                });   
                            }
                            $p->pemenang = 0;
                            $p->save();
                            $this->info("Proses pengumuman pemenang selesai [".\Carbon\Carbon::now()."]");
                            echo "\n";
                        }

                    }else{#JIKA PAKETAN
                        $this->info('Pengumuman Group ['.\Carbon\Carbon::now().']');
                        $this->info('Pemenang untuk pengumuman '.$p->kode.' ditemukan ['.\Carbon\Carbon::now().']');
                        #MENCARI DATA PEMENANG
                        $data['pemenang'] = PengumumanUser::with('userInfo')->whereNotNull('waktu_register')->where('total_auction','>',0)->orderBy('total_auction','asc')->first();
                        $data['list_harga_eksternal'] = BarangEksternalUser::with('barangEksternalInfo')->whereHas('barangEksternalInfo',function($query1)use($p){
                            $query1->where('pengumuman_id',$p->id);
                        })->where('user_id',$data['pemenang']->user_id)->where('status',1)->get();
                        $p->pemenang = $data['pemenang']->user_id;
                        $this->info('Pemenang pengumuman '.$p->kode.' ditetapkan '.$data['pemenang']->userInfo->nama.' ['.\Carbon\Carbon::now().']');

                        $data['pengumuman'] = $p;

                        
                        $this->info("Membuat kontrak [".\Carbon\Carbon::now()."]");
                        $createKontrak = \PDF::loadView('kontrak',$data)->save(storage_path('app/kontrak/kontrak_'.$data['pengumuman']->id.'_'.$data['pemenang']->userInfo->id.'.pdf'));
                        if($createKontrak) $this->info("Dokumen kontrak untuk pengumuman ".$p->kode." berhasil dibuat [".\Carbon\Carbon::now().']');
                        
                        // CREATE DOKUMEN BERITA ACARA
                        $this->info("Membuat berita acara [".\Carbon\Carbon::now()."]");
                        $createBeritaAcara = \PDF::loadView('berita_acara',$data)->setPaper('folio','potrait')->save(storage_path('app/berita_acara/berita_acara_'.$data['pengumuman']->id.'_'.$data['pemenang']->userInfo->id.'.pdf'));
                        if($createBeritaAcara) $this->info("Berita acara telah dibuat [".\Carbon\Carbon::now()."]");
                        else $this->info("!!Berita acara gagal dibuat [".\Carbon\Carbon::now()."]");


                        $this->info('mengirim email ke pemenang : '.$data['pemenang']->userInfo->email.' ['.\Carbon\Carbon::now().']');
                        $p->save();
                        Mail::send('mail_pemenang', $data, function($message) use($data){
                            $message->to($data['pemenang']->userInfo->email, $data['pemenang']->userInfo->nama)->subject("Pengumuman Hasil Lelang Proyek ".$data['pengumuman']->kode);
                            $message->from(env('MAIL_USERNAME'),"PT.PALL Indonesia (Persero)");
                        });
                        $this->info("Email berhasil dikirim ".' ['.\Carbon\Carbon::now().']');
                        $this->info("Proses pengumuman pemenang selesai [".\Carbon\Carbon::now()."]");
                        echo "\n";
                    }
                }
            }
        }
        
    }
}
