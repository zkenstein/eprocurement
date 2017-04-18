<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auction';
    protected $fillable = ['pengumuman_barang_id','user_id','harga'];

    public function pengumumanBarangInfo()
    {
    	return $this->belongsTo('App\PengumumanBarang','pengumuman_barang_id');
    }

    public function userInfo()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
