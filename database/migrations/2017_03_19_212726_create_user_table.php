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
            $table->string('password')->nullable();
            $table->string('telp')->unique();
            $table->string('session_id')->nullable();
            $table->enum('role',['admin','subkontraktor']);
            $table->dateTime('aktif')->nullable();
            $table->dateTime('kadaluarsa')->nullable();
            $table->integer('cluster_id')->unsigned()->nullable();
            $table->foreign('cluster_id')->references('id')->on('cluster')->onDelete('cascade');;
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
