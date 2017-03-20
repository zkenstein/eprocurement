<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanUser extends Model
{
    protected $table = 'pengumuman_user';
    protected $fillable = ['pengumuman_id','user_id'];

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\Pengumuman');
    }

    public function userInfo()
    {
    	return $this->belongsTo('App\User');
    }
}