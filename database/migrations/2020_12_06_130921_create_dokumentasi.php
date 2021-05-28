<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumentasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dokumentasi');
            $table->string('tanggal');
            $table->string('kepada');
            $table->text('tentang');
            $table->string('nomor_nodim');
            $table->integer('created_by');
            $table->integer('is_prosess');
            $table->integer('is_status');
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
        Schema::dropIfExists('dokumentasi');
    }
}
