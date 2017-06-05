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
            $table->string('telp');
            $table->text('bidang_usaha');
            $table->string('session_id')->nullable();
            $table->enum('role',['admin','subkontraktor','pic']);
            $table->dateTime('aktif')->nullable();
            $table->dateTime('kadaluarsa')->nullable();
            $table->text('alamat');
            $table->string('fax')->nullable();
            $table->string('pimpinan')->nullable();
            // $table->date('exp_date')->nullable();
            // $table->string('ref_bank')->nullable();
            // $table->string('no_rekening')->nullable();
            $table->string('cp')->nullable();
            $table->string('telp_cp')->nullable();
            $table->string('email_cp')->nullable();
            $table->string('klas_usaha')->nullable();
            $table->string('klas')->nullable();
            // $table->string('klas_siup')->nullable(); 
            // $table->string('modal_siup')->nullable();
            // $table->string('no_skt')->nullable();
            // $table->string('surat_permohonan')->nullable();
            // $table->date('tanggal_srt')->nullable();
            // $table->string('npwp')->nullable();
            // $table->string('tdp')->nullable();
            // $table->string('siup')->nullable();
            // $table->date('tanggal_siup')->nullable();
            $table->string('cluster')->nullable()->comment = "1 = barang, 2 = jasa";
            $table->integer('departemen_id')->unsigned();
            $table->foreign('departemen_id')->references('id')->on('departemen')->onDelete('cascade');
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
