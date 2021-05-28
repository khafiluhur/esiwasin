<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandasanHukumKepsesjensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landasan_hukum_kepsesjens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode_kepsesjen');
            $table->string('landasan_hukum');
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
        Schema::dropIfExists('landasan_hukum_kepsesjens');
    }
}
