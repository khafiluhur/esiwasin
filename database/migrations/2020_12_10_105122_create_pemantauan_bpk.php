<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemantauanBpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemantauan_bpk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->string('keterangan');
            $table->string('berkas_temuan');
            $table->string('tanggal');
            $table->string('tahun');
            $table->integer('status');
            $table->integer('createdBy');
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
        Schema::dropIfExists('pemantauan_bpk');
    }
}
