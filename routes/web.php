<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'AuthController@index')->name('index');
Route::post('/', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'AuthController@profile')->name('view.profile');
    Route::post('/changepassword', 'AuthController@changePassword')->name('change.password');
    Route::get('/edit', 'AuthController@editProfile')->name('edit.profile');
    Route::get('/setting', 'AuthController@setting')->name('setting.profile');
});


Route::group(['prefix' => 'download'], function () {
    Route::prefix('audit')->group(function () {
        Route::get('/keuanagn/{file}', 'DownloadsController@download1')->name('audit.keuangan.download');
        Route::get('/kinerja/{file}', 'DownloadsController@download2')->name('audit.kinerja.download');
        Route::get('/tujuantertentu/{file}', 'DownloadsController@download3')->name('audit.tujuantertentu.download');
    });
    Route::prefix('review')->group(function () {
        Route::get('/keuanagn/{file}', 'DownloadsController@download4')->name('review.keuangan.download');
        Route::get('/anggaran/{file}', 'DownloadsController@download5')->name('review.anggaran.download');
        Route::get('/lakip/{file}', 'DownloadsController@download8')->name('review.lakip.download');
        Route::get('/rkbmn/{file}', 'DownloadsController@download9')->name('review.rkbmn.download');
    });
    Route::prefix('pemantauan')->group(function () {
        Route::get('/bpk/{file}', 'DownloadsController@download12')->name('pemantauan.bpk.download');
        Route::get('/lhs/{file}', 'DownloadsController@download13')->name('pemantauan.lh.download');
        Route::get('/spip/{file}', 'DownloadsController@download14')->name('pemantauan.spip.download');
        Route::get('/lhkasn/{file}', 'DownloadsController@download15')->name('pemantauan.lhkasn.download');
    });
    Route::prefix('pengawasan')->group(function () {
        Route::get('/konsultasi/{file}', 'DownloadsController@download16')->name('pengawasan.kosultasi.download');
        Route::get('/sosialisasi/{file}', 'DownloadsController@download17')->name('pengawasan.sosialisasi.download');
        Route::get('/asistensi/{file}', 'DownloadsController@download18')->name('pengawasan.asistensi.download');
        Route::get('/rbzi/{file}', 'DownloadsController@download19')->name('pengawasan.rbzi.download');
        Route::get('/sakip/{file}', 'DownloadsController@download20')->name('pengawasan.sakip.download');
    });
    Route::prefix('evaluasi')->group(function () {
        Route::get('/sakip/{file}', 'DownloadsController@download6')->name('evaluasi.sakip.download');
        Route::get('/rb/{file}', 'DownloadsController@download7')->name('evaluasi.rb.download');
        Route::get('/spip/{file}', 'DownloadsController@download10')->name('evaluasi.spip.download');
        Route::get('/iacm/{file}', 'DownloadsController@download11')->name('evaluasi.iacm.download');
    });
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::prefix('penyerapan')->group(function () {
    Route::get('/', 'Dashboard\PenyerapanController@index')->name('penyerapan')->middleware('auth');
    Route::get('/detail/{id}', 'Dashboard\PenyerapanController@detail')->name('detail.penyerapan')->middleware('auth');
    Route::post('/detail/{id}', 'Dashboard\PenyerapanController@edit')->name('edit.penyerapan');
});
Route::get('/penyerapan', 'Dashboard\PenyerapanController@index')->name('penyerapan')->middleware('auth');
Route::prefix('useradmin')->group(function () {
    Route::get('/', 'Dashboard\UsersAdminController@index')->name('useradmin')->middleware('auth');
    Route::post('/tambah', 'Dashboard\UsersAdminController@tambah')->name('tambah.useradmin');
    Route::get('/ubah/{id}', 'Dashboard\UsersAdminController@detail')->name('ubah.useradmin');
    Route::post('/ubah/{id}', 'Dashboard\UsersAdminController@ubah')->name('edit.useradmin');
});
Route::group(['prefix' => 'audit1'], function() {
    Route::get('/', 'Dashboard\AuditController@index')->name('audit')->middleware('auth');
    Route::prefix('keuangan')->group(function () {
        Route::post('/', 'Dashboard\AuditController@post1')->name('keuangan.audit');
        Route::post('/setuju', 'Dashboard\AuditController@approve1')->name('setuju.keuangan');
        Route::get('/delete/{id}', 'Dashboard\AuditController@delete1')->name('delete.keuangan');
    });
    Route::prefix('kinerja')->group(function () {
        Route::post('/', 'Dashboard\AuditController@post2')->name('kinerja.audit');
        Route::post('/setuju', 'Dashboard\AuditController@approve2')->name('setuju.kinerja');
        Route::get('/delete/{id}', 'Dashboard\AuditController@delete2')->name('delete.kinerja');
    });
    Route::prefix('tujuan_tertentu')->group(function () {
        Route::post('/', 'Dashboard\AuditController@post3')->name('tujuantertentu.audit');
        Route::post('/setuju', 'Dashboard\AuditController@approve3')->name('setuju.tujuantertentu');
        Route::get('/delete/{id}', 'Dashboard\AuditController@delete3')->name('delete.tujuantertentu');
    });
});

Route::group(['prefix' => 'review'], function() {
        Route::get('/', 'Dashboard\ReviewController@index')->name('reviu')->middleware('auth');
    Route::prefix('keuangan')->group(function () {
        Route::post('/', 'Dashboard\ReviewController@post1')->name('laporan.review');
        Route::post('/setuju', 'Dashboard\ReviewController@approve1')->name('setuju.laporan');
        Route::get('/delete/{id}', 'Dashboard\ReviewController@delete1')->name('delete.laporan');
    });
    Route::prefix('kegiatan')->group(function () {
        Route::post('/', 'Dashboard\ReviewController@post2')->name('kegiatan.review');
        Route::post('/setuju', 'Dashboard\ReviewController@approve2')->name('setuju.kegiatan');
        Route::get('/delete/{id}', 'Dashboard\ReviewController@delete2')->name('delete.kegiatan');
    });
    Route::prefix('lakip')->group(function () {
        Route::post('/', 'Dashboard\ReviewController@post3')->name('lakip.review');
        Route::post('/setuju', 'Dashboard\ReviewController@approvelakip')->name('setuju.lakip');
        Route::get('/delete/{id}', 'Dashboard\ReviewController@delete3')->name('delete.lakip');
    });
    Route::prefix('rkbm')->group(function () {
        Route::post('/', 'Dashboard\ReviewController@post4')->name('rkbmn.review');
        Route::post('/setuju', 'Dashboard\ReviewController@approve4')->name('setuju.rkbmn');
        Route::get('/delete/{id}', 'Dashboard\ReviewController@delete4')->name('delete.rkbmn');
    });
});

Route::group(['prefix' => 'evaluasi'], function() {
        Route::get('/', 'Dashboard\EvaluasiController@index')->name('evaluasi')->middleware('auth');
    Route::prefix('sakip')->group(function () {
        Route::post('/', 'Dashboard\EvaluasiController@post1')->name('sakip.evaluasi');
        Route::post('/setuju', 'Dashboard\EvaluasiController@approve1')->name('setuju.sakip');
        Route::get('/delete/{id}', 'Dashboard\EvaluasiController@delete1')->name('delete.sakip');
    });
    Route::prefix('reformasi')->group(function () {
        Route::post('/', 'Dashboard\EvaluasiController@post2')->name('reformasi.evaluasi');
        Route::post('/setuju', 'Dashboard\EvaluasiController@approve2')->name('setuju.reformasi');
        Route::get('/delete/{id}', 'Dashboard\EvaluasiController@delete2')->name('delete.reformasi');
    });
    Route::prefix('spip')->group(function () {
        Route::post('/', 'Dashboard\EvaluasiController@post3')->name('spip.evaluasi');
        Route::post('/setuju', 'Dashboard\EvaluasiController@approve3')->name('setuju.spip');
        Route::get('/delete/{id}', 'Dashboard\EvaluasiController@delete3')->name('delete.spip');
    });
    Route::prefix('iacm')->group(function () {
        Route::post('/', 'Dashboard\EvaluasiController@post4')->name('iacm.evaluasi');
        Route::post('/setuju', 'Dashboard\EvaluasiController@approve4')->name('setuju.iacm');
        Route::get('/delete/{id}', 'Dashboard\EvaluasiController@delete4')->name('delete.iacm');
    });
});

Route::group(['prefix' => 'pemantauan'], function() {
    Route::get('/', 'Dashboard\PemantauanController@index')->name('pemantauan');
    Route::prefix('bpk')->group(function () {
        Route::post('/', 'Dashboard\PemantauanController@post1')->name('bpk.pemantauan');
    });
    Route::prefix('lha')->group(function () {
        Route::post('/', 'Dashboard\PemantauanController@post2')->name('lha.pemantauan');
    });
    Route::prefix('spip')->group(function () {
        Route::post('/', 'Dashboard\PemantauanController@post3')->name('spip.pemantauan');
    });
    Route::prefix('lhkasn')->group(function () {
        Route::post('/', 'Dashboard\PemantauanController@post4')->name('lhkasn.pemantauan');
    });
});

Route::group(['prefix' => 'pengawasan'], function() {
        Route::get('/', 'Dashboard\PengawasanController@index')->name('pengawasan')->middleware('auth');
    Route::prefix('konsultasi')->group(function () {
        Route::post('/', 'Dashboard\PengawasanController@post1')->name('konsultasi.pengawasan');
        Route::post('/setuju', 'Dashboard\PengawasanController@approve1')->name('setuju.konsultasi');
    });
    Route::prefix('pelatihan')->group(function () {
        Route::post('/', 'Dashboard\PengawasanController@post2')->name('pelatihan.pengawasan');
        Route::post('/setuju', 'Dashboard\PengawasanController@approve2')->name('setuju.pelatihan');
    });
    Route::prefix('kordinasi')->group(function () {
        Route::post('/', 'Dashboard\PengawasanController@post3')->name('kordinasi.pengawasan');
        Route::post('/setuju', 'Dashboard\PengawasanController@approve3')->name('setuju.kordinasi');
    });
    Route::prefix('reformasi')->group(function () {
        Route::post('/', 'Dashboard\PengawasanController@post4')->name('reformasi.pengawasan');
    });
    Route::prefix('sakip')->group(function () {
        Route::post('/', 'Dashboard\PengawasanController@post5')->name('sakip.pengawasan');
    });
});

Route::group(['prefix' => 'dokumentasi'], function() {
        Route::get('/', 'Dashboard\DokumentasiController@index')->name('dokumentasi')->middleware('auth');
        Route::prefix('nodim')->group(function () {
        Route::post('/', 'Dashboard\DokumentasiController@post1')->name('nodim.dokumentasi');
        Route::post('/setuju', 'Dashboard\DokumentasiController@approve1')->name('setuju.nodim');
    });
    Route::prefix('kepseajen')->group(function () {
        Route::post('/', 'Dashboard\DokumentasiController@post2')->name('kepseajen.dokumentasi');
        Route::post('/setuju', 'Dashboard\DokumentasiController@approve2')->name('setuju.kepseajen');
    });
    Route::prefix('pkpt')->group(function () {
        Route::post('/', 'Dashboard\DokumentasiController@post3')->name('pkpt.dokumentasi');
        Route::get('/{id}', 'Dashboard\DokumentasiController@getById')->name('detail.pkpt.dokumentasi');
        Route::post('/edit/{id}', 'Dashboard\DokumentasiController@edit')->name('edit.pkpt.dokumentasi');
        Route::get('/delete/{id}', 'Dashboard\DokumentasiController@delete')->name('delete.pkpt.dokumentasi');
    });
    Route::prefix('notulensi')->group(function () {
        Route::post('/', 'Dashboard\DokumentasiController@post4')->name('notulensi.dokumentasi');
        Route::post('/setuju', 'Dashboard\DokumentasiController@approve4')->name('setuju.notulensi');
    });
});

Route::group(['prefix' => 'laporan'], function() {
    // Route::get('/', 'Dashboard\LaporanController@index')->name('laporan')->middleware('auth');
    Route::prefix('laporan_audit')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanAudit')->name('table.audit.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get1')->name('audit.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanAudit')->name('audit.cari.laporan')->middleware('auth');
        Route::get('/laporan/audit/{id}', 'Dashboard\LaporanController@downloadLaporan1')->name('audit.download')->middleware('auth');
        Route::get('/downloadAudit/{id}', 'Dashboard\LaporanController@downloadGet1')->name('audit.download.laporan')->middleware('auth');
    });
    Route::prefix('laporan_reviu')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanReviu')->name('table.reviu.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get2')->name('reviu.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanReviu')->name('reviu.cari.laporan')->middleware('auth');
        Route::get('/laporan/reviu/{id}', 'Dashboard\LaporanController@downloadLaporan2')->name('reviu.download')->middleware('auth');
        Route::get('/downloadReviu/{id}', 'Dashboard\LaporanController@downloadGet2')->name('reviu.download.laporan')->middleware('auth');
    });
    Route::prefix('laporan_evaluasi')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanEvaluasi')->name('table.evaluasi.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get3')->name('evaluasi.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanEvaluasi')->name('evaluasi.cari.laporan')->middleware('auth');
        Route::get('/laporan/evaluasi/{id}', 'Dashboard\LaporanController@downloadLaporan3')->name('evaluasi.download')->middleware('auth');
        Route::get('/downloadEvaluasi/{id}', 'Dashboard\LaporanController@downloadGet3')->name('evaluasi.download.laporan')->middleware('auth');
    });
    Route::prefix('laporan_pemantauan')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanPemantauan')->name('table.pemantauan.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get4')->name('pemantauan.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanPemantauan')->name('pemantauan.cari.laporan')->middleware('auth');
        Route::get('/laporan/pemantauan/{id}', 'Dashboard\LaporanController@downloadLaporan4')->name('pemantauan.download')->middleware('auth');
        Route::get('/downloadPemantauan/{id}', 'Dashboard\LaporanController@downloadGet4')->name('pemantauan.download.laporan')->middleware('auth');
    });
    Route::prefix('laporan_pengawasan')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanPengawasan')->name('table.pengawasan.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get6')->name('pengawasan.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanPengawasan')->name('pengawasan.cari.laporan')->middleware('auth');
        Route::get('/laporan/pengawasan/{id}', 'Dashboard\LaporanController@downloadLaporan6')->name('pengawasan.download')->middleware('auth');
        Route::get('/downloadPengawasan/{id}', 'Dashboard\LaporanController@downloadGet6')->name('pengawasan.download.laporan')->middleware('auth');
    });
    Route::prefix('notulensi')->group(function () {
        Route::get('/', 'Dashboard\LaporanController@laporanNotulensi')->name('table.notulensi.laporan')->middleware('auth');
        // Route::get('/{id}', 'Dashboard\LaporanController@get5')->name('notulensi.laporan')->middleware('auth');
        Route::get('/cari', 'Dashboard\LaporanController@cariLaporanNotulensi')->name('notulensi.cari.laporan')->middleware('auth');
        Route::get('/laporan/notulensi/{id}', 'Dashboard\LaporanController@downloadLaporan5')->name('notulensi.download')->middleware('auth');
        Route::get('/downloadNotulensi/{id}', 'Dashboard\LaporanController@downloadGet5')->name('notulensi.download.laporan')->middleware('auth');
    });
});
