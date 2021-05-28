<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        
    	
    	DB::table('jabatan')->insert([
            'nama'=>'Super Admin',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Sesjen',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Deputi  Bidang Politik dan Strategi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Deputi Bidang Pengembangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Deputi Bidang Pengkajian dan Penginderaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Deputi Bidang Sistem Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Staf Ahli Bidang Ilmu Pengetahuan dan Teknologi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Staf Ahli Bidang Ekonomi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Staf Ahli Bidang Sosial Budaya',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Staf Ahli Bidang Pertahanan Keamanan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Staf Ahli Bidang Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi  Urusan Lingkungan Strategis Regional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Strategi Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Politik Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi  Urusan Lingkungan Strategis Internasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Hukum dan Perundang-Undangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Lingkungan Pemerintahan Negara',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Ekonomi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Informasi dan Pengolahan Data',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Pertahanan dan Keamanan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Lingkungan Sosial',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi  Urusan Lingkungan Strategis Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi  Urusan Perencanaan Kontinjensi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Lingkungan Alam',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pembantu Deputi Urusan Sosial Budaya',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kepala Biro Umum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kepala Biro Perencanaan, Organisasi dan Keuangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kepala Biro Persidangan, Sistem Informasi, dan Pengawasan Internal',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Keuangan dan Moneter',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Perundang-undangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Ekonomi Internasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Perencanaan Strategi Pembangunan Nasional Jangka Panjang',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Evaluasi dan Toleransi Risiko Pembangunan Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Mobilisasi dan Demobilisasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengumpulan dan Pengolahan Data Politik Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sumber Daya Manusia',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Bela Negara',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Militer dan Kepolisian',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Rencana Kontinjensi Ekonomi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sektor Riil',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sosial Budaya Regional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Jasa dan Pariwisata',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Kelembagaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sumber Daya Alam',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Geografi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Politik Keamanan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Telematika',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sosial Ekonomi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Politik Keamanan Regional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sosial Budaya Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Rencana Kontinjensi Politik dan Keamanan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pengembangan Penegakan Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Perumusan Pengkajian Politik Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Ekonomi Regional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Politik Keamanan Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Ekonomi Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Politik Keamanan Internasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Rencana Pembangunan Nasional Jangka Sedang dan Pendek',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Monitoring dan Evaluasi Politik Nasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sosial Budaya Internasional',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Demografi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Sosial Budaya',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Pullah Info',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Rencana Kontinjensi Sosial Budaya',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Keagamaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Bidang Kesejahteraan Sosial',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kabag TU dan Protokol Biro Umum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kabag Perlengkapan dan Pengadaan Barang/Jasa ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kabag Sistem Informasi Biro PSP',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Kabag Perencanaan Biro POK',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Ahli Madya Koordinator Kelompok Organisasi dan Tata Laksana',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Auditor Ahli Madya  Koordinator Kelompok Pengawasan Internal Biro PSP',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kepegawaian Ahli Madya  Koordinator Kelompok Kepegawaian dan Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Pengelolaan Keuangan APBN Ahli Madya  Koordinator Kelompok Keuangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Arsiparis Ahli Muda Sub Koordinator Kelompok TU ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Pengelolaan Keuangan APBN Ahli Muda Sub Koordinator',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Pengadaan Barang dan Jasa Ahli Muda Sub Koordinator Kelompok Barang Milik Negara',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pranata Humas Ahli Muda Sub Koordinator Kelompok Hubungan Media dan Publikasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pranata Komputer Ahli Muda Sub Koordinator Kelompok Data dan Keamanan Informasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Arsiparis Ahli Muda Sub Koordinator Kelompok TU',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Perencana Ahli Muda Sub Koordinator Kelompok Rencana Program dan Kinerja',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Arsiparis Ahli Muda  Sub Koordinator',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Pengelolaan Keuangan APBN Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Arsiparis Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Pengadaan Barang dan Jasa Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Penata Humas Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Arsiparis Ahli Muda ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pustakawan Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Perencana Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kepegawaian Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pranata Komputer Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Pengelolaan Keuangan APBN Ahli Muda',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Penyuluh Kearsipan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Tata Usaha',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Sistem Informasi Sub Kelompok Data dan Keamanan Informasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Perbendaharaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Manajemen Perkantoran',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pemeriksa Pelaporan dan Transaksi Keuangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Penelaah Kebijakan Pengadaan Barang/Jasa',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kebijakan BMN',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Auditor Ahli Pertama Kelompok Pengawasan Internal Biro PSP',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Keuangan Sub Kelompok Verifikasi Kelompok Keuangan Biro POK',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Laporan Hasil Pengawasan Sub Kelompok Tata Usaha Kelompok Pengawasan Internal Biro PSP',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Kelembagaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Persandian',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Organisasi dan Tata Laksana',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Rencana Program dan Kegiatan Sub Kelompok Rencana Program dan Kinerja Kelompok Perencanaan Biro POK',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Laporan Akuntabilitas Kinerja ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Sistem Informasi Perbendaharaan ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Sumber Daya Manusia ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Konsultasi dan Bantuan Hukum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Penyusun Norma Standar Prosedur dan Kriteria ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Publikasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Hubungan Antar Lembaga',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Analis Sumber Daya Manusia Aparatur',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Penata Keuangan ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Layanan Pengadaan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Keuangan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Bendahara',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengadministrasi Sarana dan Prasarana ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Instalasi Teknologi Informasi',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengelola Keamanan Sistem Informasi ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pranata Komputer Terampil ',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengadministrasi Persuratan',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        DB::table('jabatan')->insert([
            'nama'=>'Pengadministrasi Umum',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }
}
