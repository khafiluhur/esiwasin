<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriodeTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priode_laporan')->insert([
            'nama' => 'TW1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('priode_laporan')->insert([
            'nama' => 'TW2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('priode_laporan')->insert([
            'nama' => 'TW3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('priode_laporan')->insert([
            'nama' => 'TW4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
