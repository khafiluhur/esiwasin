<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Super Admin',
            'nip' => '000',
            'jabatan' => 1,
            'level' => 8,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('users')->insert([
            'nama' => 'Titin Mardyaningsih, S.E., M.M.',
            'nip' => '197502072006042000',
            'jabatan' => 73,
            'level' => 3,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('users')->insert([
            'nama' => 'Brigjen TNI. Drs. Haris Sarjana, M.M., M.Tr. (Han)',
            'nip' => '32419',
            'jabatan' => 28,
            'level' => 4,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Mila Purnama Yulianti, A.Md.',
            'nip' => '198107172008012016',
            'jabatan' => 97,
            'level' => 1,
            'group' => 2,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Alvin Rayinda Pramasha, S.E.',
            'nip' => '199208242019021002',
            'jabatan' => 106,
            'level' => 2,
            'group' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Helfrida Sinaga, S.E.',
            'nip' => '198812292019022001',
            'jabatan' => 104,
            'level' => 2,
            'group' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Dian Ayu Pertiwi, S.E.',
            'nip' => '199105182019022000',
            'jabatan' => 104,
            'level' => 1,
            'group' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Riedjanti Restu Biandari, S.E.',
            'nip' => '199207012019022000',
            'jabatan' => 106,
            'level' => 2,
            'group' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Daniel Maruli Tua Manik, S.E.',
            'nip' => '198402122019021001',
            'jabatan' => 106,
            'level' => 2,
            'group' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Andre Pamungkas, S.E.',
            'nip' => '199210082019021001',
            'jabatan' => 105,
            'level' => 5,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Dr. Ir. Harjo Susmoro, S.Sos., S.H., M.H.',
            'nip' => '8890',
            'jabatan' => 2,
            'level' => 7,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nama' => 'Bayu Prawiradisma Siregar, S.E.',
            'nip' => '198612042019021000',
            'jabatan' => 110,
            'level' => 6,
            'group' => 0,
            'is_active' => 1,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
