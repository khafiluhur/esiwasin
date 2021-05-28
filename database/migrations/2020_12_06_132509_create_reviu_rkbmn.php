<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviuRkbmn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviu_rkbmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->integer('ketua');
            $table->string('nomor_st');
            $table->string('tanggal_reviu_from');
            $table->string('tanggal_reviu_to');
            $table->text('temuan_penjelasan_reviu');
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
        Schema::dropIfExists('reviu_rkbmn');
    }
}
