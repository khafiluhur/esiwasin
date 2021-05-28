<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLaporanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis')->insert([
            'nama' => 'Audit Keuangan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Audit Kinerja',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Audit Tujuan Tertentu',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Reviu Laporan Keuangan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Reviu Kegiatan Anggaran',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Reviu LAKIP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Reviu RKBMN',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Evaluasi SAKIP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Evaluasi RB',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Maturitas SPIP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'IACM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pemantauan TL BPK',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pemantauan TL LHA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pemantauan SPIP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pemantauan LHKASN',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pengawasan Konsultasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pengawasan Sosialisasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pengawasan Asistensi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pengawasan RBZI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Pengawasan SAKIP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jenis')->insert([
            'nama' => 'Dokumentasi Notulen',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
