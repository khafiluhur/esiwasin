<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'nama' => 'Kirim',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('status')->insert([
            'nama' => 'Setuju',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('status')->insert([
            'nama' => 'Kembali',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('status')->insert([
            'nama' => 'Perbaikan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
