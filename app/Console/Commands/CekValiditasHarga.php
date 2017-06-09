<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Pengumuman;
use App\PengumumanUser;
use \Mail;

class CekValiditasHarga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cek:validitas_harga';

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
        $this->info("Cek validitas [".\Carbon\Carbon::now()."]");
        $pengumuman = Pengumuman::with(['listRegisteredUser.userInfo'])->whereHas('listUnvalidUser',function($q){})->where('validitas_harga','<=',\Carbon\Carbon::now())->get();
        if(count($pengumuman)>0){
          $this->info("Pengumuman dengan validitas harga sekarang ditemukan [".\Carbon\Carbon::now()."]");
               foreach ($pengumuman as $p){
                   foreach ($p->listRegisteredUser as $registeredUser){
                       if($registeredUser->total_auction<=0 || $registeredUser->total_auction==null){
                           $user = User::find($registeredUser->user_id);
                           $user->is_kondite = 1;
                           $user->save();
                           $data['user'] = $user;
                           $data['pengumuman'] = $p;
                           Mail::send('mail_kondite', $data, function($message) use($data){
                               $message->to($data['user']->email, $data['user']->nama)->subject("Sangsi Kondite Proyek ".$data['pengumuman']->kode);
                               $message->from(env('MAIL_USERNAME'),"PT.PALL Indonesia (Persero)");
                           });
                           $p->count_register = $p->count_register-1;
                           $p->save();
                           $this->info("Mail Kondite ke ".$user->email." selesai dikirim[".\Carbon\Carbon::now()."]");
                           $registeredUser->delete();
                           $this->info("User ".$user->nama." dihapus dari pengumuman [".\Carbon\Carbon::now()."]");
                       }
                   }
               }
        }else{
          $this->info("Pengumuman dengan validitas harga sekarang tidak ditemukan [".\Carbon\Carbon::now()."]");
        }
    }
}
