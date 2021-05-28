<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotullensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notullensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->string('nomor');
            $table->string('hari');
            $table->string('tanggal');
            $table->string('pukul');
            $table->string('pimpinan');
            $table->string('tempat');
            $table->text('catatan');
            $table->text('kesimpualan');
            $table->text('lampiran');
            $table->integer('is_prosess');
            $table->integer('is_status');
            $table->integer('created_by');
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
        Schema::dropIfExists('notullensi');
    }
}
