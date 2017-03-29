<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->dateTime('batas_awal_waktu_penawaran');
            $table->dateTime('batas_akhir_waktu_penawaran');
            $table->dateTime('validitas_harga');
            $table->dateTime('waktu_pengiriman');
            $table->double('harga_netto');
            $table->string('mata_uang');
            $table->tinyInteger('max_register');
            $table->integer('pic')->unsigned();
            $table->foreign('pic')->references('id')->on('user')->onDelete('cascade');
            $table->string('file_excel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengumuman');
    }
}
