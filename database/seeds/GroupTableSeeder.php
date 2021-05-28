<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('group')->insert([
            'ketua' => 7,
            'pengendali' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

         DB::table('group')->insert([
            'ketua' => 4,
            'pengendali' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
