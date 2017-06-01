<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kode', 'nama', 'email','password','telp','bidang_usaha','aktif','kadaluarsa','session_id','role','cluster','departemen_id','alamat','fax','pimpinan','cp','telp_cp','email_cp','klas_usaha','klas'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function listPengumuman()
    {
        return $this->hasMany('App\PengumumanUser');
    }

    public function listCluster()
    {
        return $this->hasMany('App\UserCluster');
    }

    public function listAuction()
    {
        return $this->hasMany('App\Auction','user_id','id');
    }

    public function departemenInfo()
    {
        return $this->belongsTo('App\Departemen','departemen_id');
    }
}