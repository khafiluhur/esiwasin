<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputPkptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_pkpt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kegiatan');
            $table->string('uraian_kegiatan');
            $table->string('mak');
            $table->integer('jenis');
            $table->string('biaya')->nullable();
            $table->string('output')->nullable();
            $table->string('volume')->nullable();
            $table->string('anggaran')->nullable();
            $table->string('realisasi_output')->nullable();
            $table->string('realisasi')->nullable();
            $table->string('saldo')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('input_pkpt');
    }
}
