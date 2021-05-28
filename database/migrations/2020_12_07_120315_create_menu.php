<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level');
            $table->integer('dashboard');
            $table->integer('penyerapan');
            $table->integer('penugasan');
            $table->integer('user_admin');
            $table->integer('audit');
            $table->integer('audit_keuangan');
            $table->integer('audit_kinerja');
            $table->integer('audit_tujuan_tertentu');
            $table->integer('reviu');
            $table->integer('reviu_laporan_keuangan');
            $table->integer('reviu_anggaran_kegiatan');
            $table->integer('reviu_lakip');
            $table->integer('reviu_rkbmn');
            $table->integer('evaluasi');
            $table->integer('evaluasi_sakip');
            $table->integer('evaluasi_rb');
            $table->integer('evaluasi_maturitas_spip');
            $table->integer('evaluasi_iacm');
            $table->integer('pemantauan');
            $table->integer('pemantauan_tl_bpk');
            $table->integer('pemantauan_tl_lha');
            $table->integer('pemantauan_spip');
            $table->integer('pemantauan_lhkasn');
            $table->integer('pengawasan_lainnya');
            $table->integer('pengawasan_konsultasi');
            $table->integer('pengawasan_sosialisasi');
            $table->integer('pengawasan_asistensi');
            $table->integer('pengawasan_rbzi');
            $table->integer('pengawasan_sakip');
            $table->integer('dokumentasi');
            $table->integer('dokumentasi_pengajuan_nodin');
            $table->integer('dokumentasi_pengajuan_kepsesjen');
            $table->integer('dokumentasi_input_pkpt');
            $table->integer('dokumentasi_input_notulen');
            $table->integer('laporan');
            $table->integer('laporan_hasil_audit');
            $table->integer('laporan_hasil_kolom_audit');
            $table->integer('laporan_hasil_laporan_audit');
            $table->integer('laporan_hasil_download_audit');
            $table->integer('laporan_hasil_reviu');
            $table->integer('laporan_hasil_kolom_reviu');
            $table->integer('laporan_hasil_laporan_reviu');
            $table->integer('laporan_hasil_download_reviu');
            $table->integer('laporan_hasil_evaluasi');
            $table->integer('laporan_hasil_kolom_evaluasi');
            $table->integer('laporan_hasil_laporan_evaluasi');
            $table->integer('laporan_hasil_download_evaluasi');
            $table->integer('laporan_hasil_pemantauan');
            $table->integer('laporan_hasil_kolom_pemantauan');
            $table->integer('laporan_hasil_laporan_pemantauan');
            $table->integer('laporan_hasil_download_pemantauan');
            $table->integer('laporan_hasil_pengawasan');
            $table->integer('laporan_hasil_kolom_pengawasan');
            $table->integer('laporan_hasil_laporan_pengawasan');
            $table->integer('laporan_hasil_download_pengawasan');
            $table->integer('laporan_hasil_notulen');
            $table->integer('laporan_hasil_kolom_notulen');
            $table->integer('laporan_hasil_laporan_notulen');
            $table->integer('laporan_hasil_download_notulen');
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
        Schema::dropIfExists('menu');
    }
}
