<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanBarangUser extends Model
{
    protected $table = "pengumuman_barang_user";
    protected $fillable = ['pengumuman_barang_id','user_id','harga','status'];

    public function pengumumanBarangInfo()
    {
    	return $this->belongsTo('App\PengumumanBarang','pengumuman_barang_id');
    }

    public function userInfo()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
