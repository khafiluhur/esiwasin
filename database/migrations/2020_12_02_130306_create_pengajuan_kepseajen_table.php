<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKepseajenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kepseajen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->integer('kepada');
            $table->integer('dari');
            $table->text('tentang');
            $table->string('tanggal');
            $table->integer('pejabat');
            $table->integer('jabatan');
            $table->text('catatan');
            $table->text('lampiran');
            $table->string('nomor_kepsesjen');
            $table->string('nomor');
            $table->string('tahun');
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
        Schema::dropIfExists('pengajuan_kepseajen');
    }
}
