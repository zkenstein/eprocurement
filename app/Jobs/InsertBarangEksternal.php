<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\BarangEksternal;
use App\Pengumuman;
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
        $pengumuman = Pengumuman::find($this->pengumumanId);
        $file = fopen(storage_path('app/'.$this->namaFileExcel),"r");
        $list_item = array();
        $c = 0;
        while(! feof($file)){
            $line = fgetcsv($file);
            $dataBarangEksternal = explode(";",$line[0]);
            if($line!="")
                $list_item[$c++] = BarangEksternal::create([
                    'kode'=>$dataBarangEksternal[0],
                    'deskripsi'=>$dataBarangEksternal[1],
                    'satuan'=>isset($dataBarangEksternal[2])?$dataBarangEksternal[2]:"",
                    'quantity'=>isset($dataBarangEksternal[3])?$dataBarangEksternal[3]:1,
                    'pengumuman_id'=>$this->pengumumanId
                ]);
        }
        \PDF::loadView('list_barang',['pengumuman'=>$pengumuman,'list_item'=>$list_item,'source'=>'csv'])->save(storage_path('app/'.$pengumuman->kode.'.pdf'));
        fclose($file);
    }
}
