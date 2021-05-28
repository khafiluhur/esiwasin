<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetuaTimTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ketua_tim')->insert([
            'ketua' => 7,
            'pengendali_teknis' => 2,
            'pengendali_mutu' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('ketua_tim')->insert([
            'ketua' => 4,
            'pengendali_teknis' => 2,
            'pengendali_mutu' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
