<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangEksternal extends Model
{
	protected $table = 'barang_eksternal';
    protected $fillable = ['kode','satuan','deskripsi','quantity','gambar','pdf','pengumuman_id'];

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\PengumumanBarang','pengumuman_id');
    }
}
