<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ## 1 ##
        DB::table('level')->insert([
            'nama' => 'Ketua Tim',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 2 ##
        DB::table('level')->insert([
            'nama' => 'Anggota Tim',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 3 ##
        DB::table('level')->insert([
            'nama' => 'Pengendali Teknis',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 4 ##
        DB::table('level')->insert([
            'nama' => 'Pengendali Mutu',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 5 ##
        DB::table('level')->insert([
            'nama' => 'Auditan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 6 ##
        DB::table('level')->insert([
            'nama' => 'Pegawai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 7 ##
        DB::table('level')->insert([
            'nama' => 'Sekretaris Jenderal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 8 ##
        DB::table('level')->insert([
            'nama' => 'Super Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
