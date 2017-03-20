<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = 'cluster';
    protected $fillable = ['kode','nama'];

    public function listPengumuman()
    {
    	return $this->hasMany('App\PengumumanCluster');
    }
}
