<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCluster extends Model
{
    protected $table = 'user_cluster';
    protected $fillable = ['user_id','cluster_id'];


    public function userInfo()
    {
    	return $this->belongsTo('App\User');
    }

    public function clusterInfo()
    {
    	return $this->belongsTo('App\Cluster');
    }
}
