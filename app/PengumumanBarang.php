<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanBarang extends Model
{
    protected $table = 'pengumuman_barang';
    protected $fillable = ['pengumuman_id','barang_id','quantity'];

    public function barangInfo()
    {
    	return $this->belongsTo('App\Barang','barang_id');
    }

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\Pengumuman');
    }
}
