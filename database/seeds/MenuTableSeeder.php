<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ## Super Admin ##
        DB::table('menu')->insert([
            'level' => 8,
            'dashboard' => 1,   
            'penyerapan' => 1,
            'penugasan' => 1,
            'user_admin' => 8,
            'audit' => 1,
            'audit_keuangan' => 1,
            'audit_kinerja' => 1,
            'audit_tujuan_tertentu' => 1,
            'reviu' => 1,
            'reviu_laporan_keuangan' => 1,
            'reviu_anggaran_kegiatan' => 1,
            'reviu_lakip' => 1,
            'reviu_rkbmn' => 1,
            'evaluasi' => 1,
            'evaluasi_sakip' => 1,
            'evaluasi_rb' => 1,
            'evaluasi_maturitas_spip' => 1,
            'evaluasi_iacm' => 1,
            'pemantauan' => 1,
            'pemantauan_tl_bpk' => 1,
            'pemantauan_tl_lha' => 1,
            'pemantauan_spip' => 1,
            'pemantauan_lhkasn' => 1,
            'pengawasan_lainnya' => 1,
            'pengawasan_konsultasi' => 1,
            'pengawasan_sosialisasi' => 1,
            'pengawasan_asistensi' => 1,
            'pengawasan_rbzi' => 1,
            'pengawasan_sakip' => 1,
            'dokumentasi' => 1,
            'dokumentasi_pengajuan_nodin' => 1,
            'dokumentasi_pengajuan_kepsesjen' => 1,
            'dokumentasi_input_pkpt' => 1,
            'dokumentasi_input_notulen' => 1,
            'laporan' => 1,
            'laporan_hasil_audit' => 1,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 1,
            'laporan_hasil_download_audit' => 1,
            'laporan_hasil_reviu' => 1,
            'laporan_hasil_kolom_reviu' => 1,
            'laporan_hasil_laporan_reviu' => 1,
            'laporan_hasil_download_reviu' => 1,
            'laporan_hasil_evaluasi' => 1,
            'laporan_hasil_kolom_evaluasi' => 1,
            'laporan_hasil_laporan_evaluasi' => 1,
            'laporan_hasil_download_evaluasi' => 1,
            'laporan_hasil_pemantauan' => 1,
            'laporan_hasil_kolom_pemantauan' => 1,
            'laporan_hasil_laporan_pemantauan' => 1,
            'laporan_hasil_download_pemantauan' => 1,
            'laporan_hasil_pengawasan' => 1,
            'laporan_hasil_kolom_pengawasan' => 1,
            'laporan_hasil_laporan_pengawasan' => 1,
            'laporan_hasil_download_pengawasan' => 1,
            'laporan_hasil_notulen' => 1,
            'laporan_hasil_kolom_notulen' => 1,
            'laporan_hasil_laporan_notulen' => 1,
            'laporan_hasil_download_notulen' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## Sekretaris Jenderal ##
        DB::table('menu')->insert([
            'level' => 7,
            'dashboard' => 1,   
            'penyerapan' => 1,
            'penugasan' => 1,
            'user_admin' => 1,
            'audit' => 1,
            'audit_keuangan' => 1,
            'audit_kinerja' => 1,
            'audit_tujuan_tertentu' => 1,
            'reviu' => 1,
            'reviu_laporan_keuangan' => 1,
            'reviu_anggaran_kegiatan' => 1,
            'reviu_lakip' => 1,
            'reviu_rkbmn' => 1,
            'evaluasi' => 1,
            'evaluasi_sakip' => 1,
            'evaluasi_rb' => 1,
            'evaluasi_maturitas_spip' => 1,
            'evaluasi_iacm' => 1,
            'pemantauan' => 1,
            'pemantauan_tl_bpk' => 1,
            'pemantauan_tl_lha' => 1,
            'pemantauan_spip' => 1,
            'pemantauan_lhkasn' => 1,
            'pengawasan_lainnya' => 1,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 1,
            'dokumentasi_pengajuan_nodin' => 1,
            'dokumentasi_pengajuan_kepsesjen' => 1,
            'dokumentasi_input_pkpt' => 1,
            'dokumentasi_input_notulen' => 1,
            'laporan' => 1,
            'laporan_hasil_audit' => 1,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 1,
            'laporan_hasil_reviu' => 1,
            'laporan_hasil_kolom_reviu' => 1,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 1,
            'laporan_hasil_evaluasi' => 1,
            'laporan_hasil_kolom_evaluasi' => 1,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 1,
            'laporan_hasil_pemantauan' => 1,
            'laporan_hasil_kolom_pemantauan' => 1,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 1,
            'laporan_hasil_pengawasan' => 1,
            'laporan_hasil_kolom_pengawasan' => 1,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 1,
            'laporan_hasil_notulen' => 1,
            'laporan_hasil_kolom_notulen' => 1,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## Pegawai ##
        DB::table('menu')->insert([
            'level' => 6,
            'dashboard' => 1,   
            'penyerapan' => 1,
            'penugasan' => 1,
            'user_admin' => 1,
            'audit' => 1,
            'audit_keuangan' => 1,
            'audit_kinerja' => 1,
            'audit_tujuan_tertentu' => 1,
            'reviu' => 1,
            'reviu_laporan_keuangan' => 1,
            'reviu_anggaran_kegiatan' => 1,
            'reviu_lakip' => 1,
            'reviu_rkbmn' => 1,
            'evaluasi' => 1,
            'evaluasi_sakip' => 1,
            'evaluasi_rb' => 1,
            'evaluasi_maturitas_spip' => 1,
            'evaluasi_iacm' => 1,
            'pemantauan' => 1,
            'pemantauan_tl_bpk' => 1,
            'pemantauan_tl_lha' => 1,
            'pemantauan_spip' => 1,
            'pemantauan_lhkasn' => 1,
            'pengawasan_lainnya' => 1,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 1,
            'dokumentasi_pengajuan_nodin' => 1,
            'dokumentasi_pengajuan_kepsesjen' => 1,
            'dokumentasi_input_pkpt' => 1,
            'dokumentasi_input_notulen' => 1,
            'laporan' => 1,
            'laporan_hasil_audit' => 1,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 1,
            'laporan_hasil_download_audit' => 1,
            'laporan_hasil_reviu' => 1,
            'laporan_hasil_kolom_reviu' => 1,
            'laporan_hasil_laporan_reviu' => 1,
            'laporan_hasil_download_reviu' => 1,
            'laporan_hasil_evaluasi' => 1,
            'laporan_hasil_kolom_evaluasi' => 1,
            'laporan_hasil_laporan_evaluasi' => 1,
            'laporan_hasil_download_evaluasi' => 1,
            'laporan_hasil_pemantauan' => 1,
            'laporan_hasil_kolom_pemantauan' => 1,
            'laporan_hasil_laporan_pemantauan' => 1,
            'laporan_hasil_download_pemantauan' => 1,
            'laporan_hasil_pengawasan' => 1,
            'laporan_hasil_kolom_pengawasan' => 1,
            'laporan_hasil_laporan_pengawasan' => 1,
            'laporan_hasil_download_pengawasan' => 1,
            'laporan_hasil_notulen' => 1,
            'laporan_hasil_kolom_notulen' => 1,
            'laporan_hasil_laporan_notulen' => 1,
            'laporan_hasil_download_notulen' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## Auditan ##
        DB::table('menu')->insert([
            'level' => 5,
            'dashboard' => 1,   
            'penyerapan' => 1,
            'penugasan' => 1,
            'user_admin' => 1,
            'audit' => 1,
            'audit_keuangan' => 1,
            'audit_kinerja' => 1,
            'audit_tujuan_tertentu' => 1,
            'reviu' => 1,
            'reviu_laporan_keuangan' => 1,
            'reviu_anggaran_kegiatan' => 1,
            'reviu_lakip' => 1,
            'reviu_rkbmn' => 1,
            'evaluasi' => 1,
            'evaluasi_sakip' => 1,
            'evaluasi_rb' => 1,
            'evaluasi_maturitas_spip' => 1,
            'evaluasi_iacm' => 1,
            'pemantauan' => 1,
            'pemantauan_tl_bpk' => 1,
            'pemantauan_tl_lha' => 1,
            'pemantauan_spip' => 1,
            'pemantauan_lhkasn' => 1,
            'pengawasan_lainnya' => 1,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 1,
            'dokumentasi_pengajuan_nodin' => 1,
            'dokumentasi_pengajuan_kepsesjen' => 1,
            'dokumentasi_input_pkpt' => 1,
            'dokumentasi_input_notulen' => 1,
            'laporan' => 1,
            'laporan_hasil_audit' => 1,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 1,
            'laporan_hasil_reviu' => 1,
            'laporan_hasil_kolom_reviu' => 1,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 1,
            'laporan_hasil_evaluasi' => 1,
            'laporan_hasil_kolom_evaluasi' => 1,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 1,
            'laporan_hasil_pemantauan' => 1,
            'laporan_hasil_kolom_pemantauan' => 1,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 1,
            'laporan_hasil_pengawasan' => 1,
            'laporan_hasil_kolom_pengawasan' => 1,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 1,
            'laporan_hasil_notulen' => 1,
            'laporan_hasil_kolom_notulen' => 1,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## Anggota Tim ##
        DB::table('menu')->insert([
            'level' => 2,
            'dashboard' => 2,   
            'penyerapan' => 2,
            'penugasan' => 2,
            'user_admin' => 1,
            'audit' => 2,
            'audit_keuangan' => 7,
            'audit_kinerja' => 7,
            'audit_tujuan_tertentu' => 7,
            'reviu' => 2,
            'reviu_laporan_keuangan' => 7,
            'reviu_anggaran_kegiatan' => 7,
            'reviu_lakip' => 7,
            'reviu_rkbmn' => 7,
            'evaluasi' => 2,
            'evaluasi_sakip' => 7,
            'evaluasi_rb' => 7,
            'evaluasi_maturitas_spip' => 7,
            'evaluasi_iacm' => 7,
            'pemantauan' => 2,
            'pemantauan_tl_bpk' => 7,
            'pemantauan_tl_lha' => 7,
            'pemantauan_spip' => 7,
            'pemantauan_lhkasn' => 7,
            'pengawasan_lainnya' => 2,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 2,
            'dokumentasi_pengajuan_nodin' => 6,
            'dokumentasi_pengajuan_kepsesjen' => 6,
            'dokumentasi_input_pkpt' => 6,
            'dokumentasi_input_notulen' => 6,
            'laporan' => 2,
            'laporan_hasil_audit' => 5,
            'laporan_hasil_kolom_audit' => 3,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 4,
            'laporan_hasil_reviu' => 5,
            'laporan_hasil_kolom_reviu' => 3,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 4,
            'laporan_hasil_evaluasi' => 5,
            'laporan_hasil_kolom_evaluasi' => 3,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 4,
            'laporan_hasil_pemantauan' => 5,
            'laporan_hasil_kolom_pemantauan' => 3,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 4,
            'laporan_hasil_pengawasan' => 5,
            'laporan_hasil_kolom_pengawasan' => 3,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 4,
            'laporan_hasil_notulen' => 5,
            'laporan_hasil_kolom_notulen' => 3,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## Ketua Tim ##
        DB::table('menu')->insert([
            'level' => 1,
            'dashboard' => 2,   
            'penyerapan' => 2,
            'penugasan' => 2,
            'user_admin' => 1,
            'audit' => 2,
            'audit_keuangan' => 7,
            'audit_kinerja' => 7,
            'audit_tujuan_tertentu' => 7,
            'reviu' => 2,
            'reviu_laporan_keuangan' => 7,
            'reviu_anggaran_kegiatan' => 7,
            'reviu_lakip' => 7,
            'reviu_rkbmn' => 7,
            'evaluasi' => 2,
            'evaluasi_sakip' => 7,
            'evaluasi_rb' => 7,
            'evaluasi_maturitas_spip' => 7,
            'evaluasi_iacm' => 7,
            'pemantauan' => 2,
            'pemantauan_tl_bpk' => 7,
            'pemantauan_tl_lha' => 7,
            'pemantauan_spip' => 7,
            'pemantauan_lhkasn' => 7,
            'pengawasan_lainnya' => 2,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 2,
            'dokumentasi_pengajuan_nodin' => 6,
            'dokumentasi_pengajuan_kepsesjen' => 6,
            'dokumentasi_input_pkpt' => 6,
            'dokumentasi_input_notulen' => 6,
            'laporan' => 2,
            'laporan_hasil_audit' => 5,
            'laporan_hasil_kolom_audit' => 3,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 4,
            'laporan_hasil_reviu' => 5,
            'laporan_hasil_kolom_reviu' => 3,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 4,
            'laporan_hasil_evaluasi' => 5,
            'laporan_hasil_kolom_evaluasi' => 3,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 4,
            'laporan_hasil_pemantauan' => 5,
            'laporan_hasil_kolom_pemantauan' => 3,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 4,
            'laporan_hasil_pengawasan' => 5,
            'laporan_hasil_kolom_pengawasan' => 3,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 4,
            'laporan_hasil_notulen' => 5,
            'laporan_hasil_kolom_notulen' => 3,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## Pengendali Teknis ##
        DB::table('menu')->insert([
            'level' => 3,
            'dashboard' => 2,   
            'penyerapan' => 2,
            'penugasan' => 2,
            'user_admin' => 1,
            'audit' => 2,
            'audit_keuangan' => 7,
            'audit_kinerja' => 7,
            'audit_tujuan_tertentu' => 7,
            'reviu' => 2,
            'reviu_laporan_keuangan' => 7,
            'reviu_anggaran_kegiatan' => 7,
            'reviu_lakip' => 7,
            'reviu_rkbmn' => 7,
            'evaluasi' => 2,
            'evaluasi_sakip' => 7,
            'evaluasi_rb' => 7,
            'evaluasi_maturitas_spip' => 7,
            'evaluasi_iacm' => 7,
            'pemantauan' => 2,
            'pemantauan_tl_bpk' => 7,
            'pemantauan_tl_lha' => 7,
            'pemantauan_spip' => 7,
            'pemantauan_lhkasn' => 7,
            'pengawasan_lainnya' => 2,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 2,
            'dokumentasi_pengajuan_nodin' => 2,
            'dokumentasi_pengajuan_kepsesjen' => 2,
            'dokumentasi_input_pkpt' => 2,
            'dokumentasi_input_notulen' => 2,
            'laporan' => 2,
            'laporan_hasil_audit' => 5,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 4,
            'laporan_hasil_reviu' => 5,
            'laporan_hasil_kolom_reviu' => 2,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 4,
            'laporan_hasil_evaluasi' => 5,
            'laporan_hasil_kolom_evaluasi' => 2,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 4,
            'laporan_hasil_pemantauan' => 5,
            'laporan_hasil_kolom_pemantauan' => 2,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 4,
            'laporan_hasil_pengawasan' => 5,
            'laporan_hasil_kolom_pengawasan' => 2,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 4,
            'laporan_hasil_notulen' => 5,
            'laporan_hasil_kolom_notulen' => 2,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## Pengendali Mutu ##
        DB::table('menu')->insert([
            'level' => 4,
            'dashboard' => 2,   
            'penyerapan' => 2,
            'penugasan' => 2,
            'user_admin' => 1,
            'audit' => 2,
            'audit_keuangan' => 7,
            'audit_kinerja' => 7,
            'audit_tujuan_tertentu' => 7,
            'reviu' => 2,
            'reviu_laporan_keuangan' => 7,
            'reviu_anggaran_kegiatan' => 7,
            'reviu_lakip' => 7,
            'reviu_rkbmn' => 7,
            'evaluasi' => 2,
            'evaluasi_sakip' => 7,
            'evaluasi_rb' => 7,
            'evaluasi_maturitas_spip' => 7,
            'evaluasi_iacm' => 7,
            'pemantauan' => 2,
            'pemantauan_tl_bpk' => 7,
            'pemantauan_tl_lha' => 7,
            'pemantauan_spip' => 7,
            'pemantauan_lhkasn' => 7,
            'pengawasan_lainnya' => 2,
            'pengawasan_konsultasi' => 7,
            'pengawasan_sosialisasi' => 7,
            'pengawasan_asistensi' => 7,
            'pengawasan_rbzi' => 7,
            'pengawasan_sakip' => 7,
            'dokumentasi' => 2,
            'dokumentasi_pengajuan_nodin' => 2,
            'dokumentasi_pengajuan_kepsesjen' => 2,
            'dokumentasi_input_pkpt' => 2,
            'dokumentasi_input_notulen' => 2,
            'laporan' => 2,
            'laporan_hasil_audit' => 5,
            'laporan_hasil_kolom_audit' => 1,
            'laporan_hasil_laporan_audit' => 4,
            'laporan_hasil_download_audit' => 4,
            'laporan_hasil_reviu' => 5,
            'laporan_hasil_kolom_reviu' => 2,
            'laporan_hasil_laporan_reviu' => 4,
            'laporan_hasil_download_reviu' => 4,
            'laporan_hasil_evaluasi' => 5,
            'laporan_hasil_kolom_evaluasi' => 2,
            'laporan_hasil_laporan_evaluasi' => 4,
            'laporan_hasil_download_evaluasi' => 4,
            'laporan_hasil_pemantauan' => 5,
            'laporan_hasil_kolom_pemantauan' => 2,
            'laporan_hasil_laporan_pemantauan' => 4,
            'laporan_hasil_download_pemantauan' => 4,
            'laporan_hasil_pengawasan' => 5,
            'laporan_hasil_kolom_pengawasan' => 2,
            'laporan_hasil_laporan_pengawasan' => 4,
            'laporan_hasil_download_pengawasan' => 4,
            'laporan_hasil_notulen' => 5,
            'laporan_hasil_kolom_notulen' => 2,
            'laporan_hasil_laporan_notulen' => 4,
            'laporan_hasil_download_notulen' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
