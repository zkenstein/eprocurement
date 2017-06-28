<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvValidation extends Model
{
    protected $table = 'csv_validation';
    protected $fillable = ['kode','satuan','deskripsi','quantity','gambar','pdf'];
}
