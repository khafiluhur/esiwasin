<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pangkat')->insert([
            'nama' => 'I',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pangkat')->insert([
            'nama' => 'II',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pangkat')->insert([
            'nama' => 'III',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pangkat')->insert([
            'nama' => 'IV',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pangkat')->insert([
            'nama' => 'V',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pangkat')->insert([
            'nama' => 'VI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
