<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ## 1 (X) ##
        DB::table('submenu')->insert([
            'nama' => 'Tidak diijinkan mengakses',
            'view' => 0,
            'edit' => 0,
            'copy' => 0,
            'simpan' => 0,
            'kirim' => 0,
            'unduh' => 0,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## 2 (V) ##
        DB::table('submenu')->insert([
            'nama' => 'View',
            'view' => 1,
            'edit' => 0,
            'copy' => 0,
            'simpan' => 0,
            'kirim' => 0,
            'unduh' => 0,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## 3 (V, E, Si) ##
        DB::table('submenu')->insert([
            'nama' => 'View, Edit, dan Simpan',
            'view' => 1,
            'edit' => 1,
            'copy' => 0,
            'simpan' => 1,
            'kirim' => 0,
            'unduh' => 0,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## 4 (V, E, Un) ##
        DB::table('submenu')->insert([
            'nama' => 'View, Edit, dan Unduh',
            'view' => 1,
            'edit' => 1,
            'copy' => 0,
            'simpan' => 0,
            'kirim' => 0,
            'unduh' => 1,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 5 (V, Ca) ##
        DB::table('submenu')->insert([
            'nama' => 'View, dan Cari',
            'view' => 1,
            'edit' => 0,
            'copy' => 0,
            'simpan' => 0,
            'kirim' => 0,
            'unduh' => 0,
            'cari' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 6 (V, Si, Un) ##
        DB::table('submenu')->insert([
            'nama' => 'View, Simpan, Unduh',
            'view' => 1,
            'edit' => 0,
            'copy' => 0,
            'simpan' => 1,
            'kirim' => 0,
            'unduh' => 1,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        ## 7 (V, Si, Ki) ##
        DB::table('submenu')->insert([
            'nama' => 'View, Simpan, dan Kirim',
            'view' => 1,
            'edit' => 0,
            'copy' => 0,
            'simpan' => 1,
            'kirim' => 1,
            'unduh' => 0,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        ## 8 (V, E, C, Si) ##
        DB::table('submenu')->insert([
            'nama' => 'View, Edit, Copy, dan Simpan',
            'view' => 1,
            'edit' => 1,
            'copy' => 1,
            'simpan' => 1,
            'kirim' => 0,
            'unduh' => 0,
            'cari' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
