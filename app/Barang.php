<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['kode','satuan','deskripsi','gambar','pdf'];

    public function listPengumuman()
    {
    	return $this->hasMany('App\PengumumanBarang');
    }
}
