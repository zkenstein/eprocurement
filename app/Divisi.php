<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = "divisi";
    protected $fillable = ["kode","nama","direktur","email_direktur"];

    public function listPic()
    {
    	return $this->hasMany('App\User','divisi_id');
    }
}
