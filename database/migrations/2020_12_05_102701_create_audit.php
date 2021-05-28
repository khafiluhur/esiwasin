<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('audit');
            $table->integer('created_by');
            $table->string('nomor_st');
            $table->string('ketua');
            $table->string('tanggal_audit_from');
            $table->string('tanggal_audit_to');
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
        Schema::dropIfExists('audit');
    }
}
