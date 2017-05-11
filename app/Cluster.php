<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = 'cluster';
    protected $fillable = ['kode','nama','jenis'];

    public function listPengumuman()
    {
    	return $this->hasMany('App\PengumumanCluster');
    }

    public function listUser()
    {
    	return $this->hasMany('App\UserCluster');
    }
}
