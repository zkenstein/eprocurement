<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengumuman_id')->unsigned();
            $table->foreign('pengumuman_id')->references('id')->on('pengumuman')->onDelete('cascade');;
            $table->integer('barang_id')->unsigned();
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');;
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
        Schema::drop('pengumuman_barang');
    }
}
