<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telp')->unique();
            $table->dateTime('aktif');
            $table->dateTime('kadaluarsa');
            $table->integer('cluster_id')->unsigned();
            $table->foreign('cluster_id')->references('id')->on('cluster');
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
        Schema::drop('user');
    }
}
