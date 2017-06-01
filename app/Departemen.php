<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = "departemen";
    protected $fillable = ["kode","nama","kadep","email_kadep"];

    public function listPic()
    {
    	return $this->hasMany('App\User','departemen_id');
    }
}
