<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_kinerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');
            $table->integer('ketua');
            $table->string('nomor_st');
            $table->string('tanggal_audit_from');
            $table->string('tanggal_audit_to');
            $table->text('temuan_judul');
            $table->text('temuan_kondisi');
            $table->text('temuan_kriteria');
            $table->text('temuan_sebab');
            $table->text('temuan_akibat');
            $table->integer('created_by');
            $table->integer('is_prosess');
            $table->integer('is_status');
            $table->integer('is_publish');
            $table->integer('is_save');
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
        Schema::dropIfExists('audit_kinerja');
    }
}
