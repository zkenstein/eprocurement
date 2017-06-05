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
            $table->string('deskripsi')->nullable();
            $table->dateTime('batas_awal_waktu_penawaran');
            $table->dateTime('batas_akhir_waktu_penawaran');
            $table->dateTime('validitas_harga');
            $table->dateTime('waktu_pengiriman');
            $table->double('nilai_hps')->default(0);
            $table->string('mata_uang')->default("-");
            $table->integer('max_register');
            $table->integer('count_register')->default(0);
            $table->integer('pemenang')->unsigned()->nullable();
            $table->foreign('pemenang')->references('id')->on('user')->onDelete('cascade');
            $table->integer('pic')->unsigned();
            $table->foreign('pic')->references('id')->on('user')->onDelete('cascade');
            $table->string('file_excel')->nullable();
            $table->dateTime('start_auction');
            $table->integer('durasi')->default(0);
            $table->text('syarat_dan_ketentuan');
            $table->tinyInteger('cc_kadep')->default(0)->comment = "0 = tidak mengirim CC, 1 = mengirim CC";
            $table->string('jenis')->default('group');
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
