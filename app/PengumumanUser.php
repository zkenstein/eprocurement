<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanUser extends Model
{
    protected $table = 'pengumuman_user';
    protected $fillable = ['pengumuman_id','user_id','kode_masuk'];

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\Pengumuman','pengumuman_id');
    }

    public function userInfo()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}