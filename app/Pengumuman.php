<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['kode','batas_awal_waktu_penawaran','batas_akhir_waktu_penawaran','validitas_harga','waktu_pengiriman','harga_netto','mata_uang','max_register','pic','file_excel','start_auction','durasi'];

    public function listCluster(){
    	return $this->hasMany('App\PengumumanCluster');
    }

    public function listUser(){
    	return $this->hasMany('App\PengumumanUser');
    }

    public function listRegisteredUser()
    {
        return $this->hasMany('App\PengumumanUser')->whereNotNull('waktu_register');   
    }

    public function listBarang()
    {
    	return $this->hasMany('App\PengumumanBarang');
    }

    public function listBarangEksternal()
    {
        return $this->hasMany('App\BarangEksternal');
    }

    public function picInfo()
    {
        return $this->hasOne('App\User','id','pic');
    }

    public function listAuction()
    {
        return $this->hasMany('App\Auction','pengumuman_id');
    }

    public function listActiveAuction()
    {
        return $this->hasMany('App\Auction','pengumuman_id')->where('status',1);
    }

    public function pemenangInfo()
    {
        return $this->hasOne('App\User','id','pemenang');
    }
}
