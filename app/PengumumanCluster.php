<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengumumanCluster extends Model
{
    protected $table = 'pengumuman_cluster';
    protected $fillable = ['pengumuman_id','cluster_id'];

    public function pengumumanInfo()
    {
    	return $this->belongsTo('App\Pengumuman');
    }

    public function clusterInfo()
    {
    	return $this->belongsTo('App\Cluster','cluster_id');
    }
}
