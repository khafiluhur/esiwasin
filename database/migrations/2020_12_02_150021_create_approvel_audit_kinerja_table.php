<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovelAuditKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvel_audit_kinerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('audit_kinerja');
            $table->integer('users_pembuat');
            $table->integer('status_pembuat');
            $table->string('tanggal_pembuat');
            $table->string('jam_pembuat');
            $table->text('komentar_pembuat');
            $table->integer('users_ketua');
            $table->integer('status_ketua');
            $table->string('tanggal_ketua');
            $table->string('jam_ketua');
            $table->text('komentar_ketua');
            $table->integer('users_pt');
            $table->integer('status_pt');
            $table->string('tanggal_pt');
            $table->string('jam_pt');
            $table->text('komentar_pt');
            $table->integer('users_pm');
            $table->integer('status_pm');
            $table->string('tanggal_pm');
            $table->string('jam_pm');
            $table->text('komentar_pm');
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
        Schema::dropIfExists('approvel_audit_kinerja');
    }
}
