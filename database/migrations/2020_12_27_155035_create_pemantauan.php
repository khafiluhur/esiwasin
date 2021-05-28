<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemantauan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemantauan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pemantauan');
            $table->integer('created_by');
            $table->string('tanggal_pemantauan_from');
            $table->string('tanggal_pemantauan_to');
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
        Schema::dropIfExists('pemantauan');
    }
}
