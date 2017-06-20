<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanBarangUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman_barang_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengumuman_barang_id')->unsigned();
            $table->foreign('pengumuman_barang_id')->references('id')->on('pengumuman_barang')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->double('harga');
            $table->tinyInteger('status')->default(1);
            $table->string('grup')->nullable();
            $table->boolean('is_win')->default(0);
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
        Schema::drop('pengumuman_barang_user');
    }
}
