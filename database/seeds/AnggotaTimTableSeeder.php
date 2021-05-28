<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaTimTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggota_tim')->insert([
            'ketua' => 7,
            'anggota' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('anggota_tim')->insert([
            'ketua' => 7,
            'anggota' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('anggota_tim')->insert([
            'ketua' => 7,
            'anggota' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('anggota_tim')->insert([
            'ketua' => 7,
            'anggota' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
