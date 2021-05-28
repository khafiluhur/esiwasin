<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawasan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pengawasan');
            $table->integer('created_by');
            $table->string('tanggal_pengawasan_from');
            $table->string('tanggal_pengawasan_to');
            $table->string('ketua');
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
        Schema::dropIfExists('pengawasan');
    }
}
