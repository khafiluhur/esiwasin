<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('golongan')->insert([
            'nama' => 'Ia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'Ib',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'Ic',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'IIa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'IIb',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'IIIa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'IVa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'Va',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('golongan')->insert([
            'nama' => 'VIa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
