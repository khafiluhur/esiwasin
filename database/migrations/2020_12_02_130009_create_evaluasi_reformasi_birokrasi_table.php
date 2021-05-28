<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiReformasiBirokrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_reformasi_birokrasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->integer('ketua');
            $table->string('nomor_st');
            $table->string('tanggal_evaluasi_from');
            $table->string('tanggal_evaluasi_to');
            $table->string('temuan_penjelasan');
            $table->integer('created_by');
            $table->integer('is_prosess');
            $table->integer('is_status');
            $table->integer('is_publish');
            $table->integer('is_save');
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
        Schema::dropIfExists('evaluasi_reformasi_birokrasi');
    }
}
