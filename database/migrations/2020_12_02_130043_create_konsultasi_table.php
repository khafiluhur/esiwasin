<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->integer('pegawai');
            $table->string('nomor_st');
            $table->string('tanggal');
            $table->text('judul');
            $table->text('penjelasan');
            $table->integer('created_by');
            $table->integer('is_prosess');
            $table->integer('is_status');
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
        Schema::dropIfExists('konsultasi');
    }
}
