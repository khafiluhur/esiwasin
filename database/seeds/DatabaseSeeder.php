<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PositionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(JenisTableSeeder::class);
        $this->call(PriodeTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(SubMenuTableSeeder::class);
        $this->call(PangkatTableSeeder::class);
        $this->call(GolonganTableSeeder::class);
        $this->call(AnggotaTimTableSeeder::class);
        $this->call(KetuaTimTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(JenisLaporanTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
