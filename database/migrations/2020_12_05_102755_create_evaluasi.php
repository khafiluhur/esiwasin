<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('evaluasi');
            $table->integer('created_by');
            $table->string('nomor_st');
            $table->string('ketua');
            $table->string('tanggal_evaluasi_from');
            $table->string('tanggal_evaluasi_to');
            $table->integer('is_prosess');
            $table->integer('jenis');
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
        Schema::dropIfExists('evaluasi');
    }
}
