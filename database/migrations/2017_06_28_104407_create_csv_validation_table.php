<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsvValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_validation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->text('deskripsi');
            $table->string('satuan');
            $table->string('quantity',20);
            $table->string('gambar')->nullable()->default('default.gif');
            $table->string('pdf')->nullable();
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
        Schema::drop('csv_validation');
    }
}
