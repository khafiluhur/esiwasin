<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_laporan')->insert([
            'nama' => 'Unit Pengendalian Gratifikasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
