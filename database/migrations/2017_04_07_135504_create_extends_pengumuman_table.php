<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendsPengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extends_pengumuman', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('batas_akhir_waktu_penawaran');
            $table->dateTime('validitas_harga');
            $table->dateTime('waktu_pengiriman');
            $table->tinyInteger('max_register');
            $table->dateTime('start_auction');
            $table->tinyInteger('durasi')->default(0);
            $table->integer('pengumuman_id')->unsigned();
            $table->foreign('pengumuman_id')->references('id')->on('pengumuman')->onDelete('cascade');
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
        Schema::drop('extends_pengumuman');
    }
}
