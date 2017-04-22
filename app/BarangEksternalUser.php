<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangEksternalUser extends Model
{
    protected $table = "barang_eksternal_user";
    protected $fillable = ['barang_eksternal_id','user_id','harga','status'];

    public function barangEksternalInfo()
    {
    	return $this->belongsTo('App\BarangEksternal','barang_eksternal_id');
    }

    public function userInfo()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
