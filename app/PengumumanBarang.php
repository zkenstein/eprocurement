<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanBarang extends Model
{
    protected $table = 'pengumuman_barang';
    protected $fillable = ['pengumuman_id','barang_id'];

    public function barangInfo()
    {
    	return $this->belongsTo('App\Barang');
    }

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\Pengumuman');
    }
}
