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

    // public function inUserAuction()
    // {
    // 	return $this->hasOne('App\BarangEksternalUser','barang_eksternal_id','id')->where('user_id',session('id'))->where('status',1);
    // }

    // public function inAuction()
    // {
    //     return $this->hasMany('App\PengumumanBarang','barang_id','id')->where('status',1);
    // }
}
