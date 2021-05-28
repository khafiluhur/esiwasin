<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('view');
            $table->integer('edit');
            $table->integer('copy');
            $table->integer('simpan');
            $table->integer('kirim');
            $table->integer('unduh');
            $table->integer('cari');
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
        Schema::dropIfExists('submenu');
    }
}
