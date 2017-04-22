<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangEksternalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_eksternal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->text('deskripsi');
            $table->string('satuan');
            $table->string('quantity',20);
            $table->string('gambar')->nullable()->default('default.gif');
            $table->string('pdf')->nullable();
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
        Schema::drop('barang_eksternal');
    }
}
