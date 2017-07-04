<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanBarang extends Model
{
    protected $table = 'pengumuman_barang';
    protected $fillable = ['pengumuman_id','barang_id','quantity'];

    public function barangInfo()
    {
    	return $this->hasOne('App\Barang','id','barang_id');
    }

    public function pengumumanInfo()
    {
    	return $this->hasOne('App\Pengumuman','id','pengumuman_id');
    }

    public function inUserAuction()
    {
        return $this->hasOne('App\PengumumanBarangUser','pengumuman_barang_id','id')->where('user_id',session('id'))->where('status',1);
    }

    public function inAuction()
    {
        return $this->hasMany('App\PengumumanBarangUser','pengumuman_barang_id','id')->where('status',1);
    }
}
