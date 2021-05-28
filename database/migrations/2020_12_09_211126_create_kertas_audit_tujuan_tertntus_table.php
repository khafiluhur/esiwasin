<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKertasAuditTujuanTertntusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kertas_audit_tujuan_tertntus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('audit_tujuan_tertentu');
            $table->integer('kode_audit_tujuan_tertentu');
            $table->string('filename');
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
        Schema::dropIfExists('kertas_audit_tujuan_tertntus');
    }
}
