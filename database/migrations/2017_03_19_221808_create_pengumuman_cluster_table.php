<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanClusterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman_cluster', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengumuman_id')->unsigned();
            $table->foreign('pengumuman_id')->references('id')->on('pengumuman')->onDelete('cascade');;
            $table->integer('cluster_id')->unsigned();
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
        Schema::drop('pengumuman_cluster');
    }
}
