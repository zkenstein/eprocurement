<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\BarangEksternal;
class InsertBarangEksternal extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $pengumumanId;
    protected $namaFileExcel;
    

    public function __construct($pengumumanId, $namaFileExcel)
    {
        $this->pengumumanId = $pengumumanId;
        $this->namaFileExcel = $namaFileExcel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = fopen(storage_path('app/'.$this->namaFileExcel),"r");
        while(! feof($file)){
            $line = fgetcsv($file);
            $dataBarangEksternal = explode(";",$line[0]);
            if($line!="")
                BarangEksternal::create([
                    'kode'=>$dataBarangEksternal[0],
                    'deskripsi'=>$dataBarangEksternal[1],
                    'satuan'=>isset($dataBarangEksternal[2])?$dataBarangEksternal[2]:"",
                    'quantity'=>isset($dataBarangEksternal[3])?$dataBarangEksternal[3]:1,
                    'pengumuman_id'=>$this->pengumumanId
                ]);
        }
        fclose($file);
    }
}
