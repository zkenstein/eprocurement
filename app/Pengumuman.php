<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['kode','mulai_auction','selesai_auction','max_user','pic','pemenang'];

    public function listCluster(){
    	return $this->hasMany('App\PengumumanCluster');
    }

    public function listUser(){
    	return $this->hasMany('App\PengumumanUser');
    }

    public function listBarang()
    {
    	return $this->hasMany('App\PengumumanBarang');
    }

    public function picInfo()
    {
        return $this->hasOne('App\User','id','pic');
    }
}
