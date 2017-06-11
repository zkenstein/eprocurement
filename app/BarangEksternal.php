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

    public function inUserAuction()
    {
    	return $this->hasOne('App\BarangEksternalUser','barang_eksternal_id','id')->where('user_id',session('id'))->where('status',1);
    }

    public function inAuction()
    {
        return $this->hasMany('App\BarangEksternalUser','barang_eksternal_id','id')->where('status',1);
    }
}
