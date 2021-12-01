<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersAdminController extends Controller
{

    public function index()
    {
        $table = DB::table('users')
                ->select('users.*', 'jabatan.nama as jabatan', 'level.nama as level')
                ->join('jabatan', 'jabatan.id', '=', 'users.jabatan')
                ->join('level', 'level.id', '=', 'users.level')
                ->get();
        $ketua = DB::table('users')
                 ->where('level', 1)
                ->get();
        $pt = DB::table('users')
              ->where('level', 3)
              ->get();
        $pm = DB::table('users')
              ->where('level', 4)
              ->get();
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $jabatan = DB::table('jabatan') ->get();  
        $level = DB::table('level')->get();    
        $users = DB::table('users')->get();    
        $page = "useradmin"; 
        return view('dashboard.useradmin', compact('page', 'table', 'jabatan', 'level', 'users', 'ketua', 'pt', 'pm', 'permission'));
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|unique:users',
            'nama' => 'required',
            'jabatan' => 'required',
            'level' => 'required',
            'is_active' => 'required'
        ]);

        if($request->level == 1) 
        {
           $this->validate($request, [
            'pm' => 'required',
            'pt' => 'required'
           ]); 

            DB::table('users')->insert([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'level' => $request->level,
                'is_active' => $request->is_active,
                'group' => 0,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('permission')->insert([
                'nip' => $request->nip,
                'dashboard' => 2,   
                'penyerapan' => 2,
                'penugasan' => 2,
                'user_admin' => 1,
                'audit' => 2,
                'audit_keuangan' => 7,
                'audit_kinerja' => 7,
                'audit_tujuan_tertentu' => 7,
                'reviu' => 2,
                'reviu_laporan_keuangan' => 7,
                'reviu_anggaran_kegiatan' => 7,
                'reviu_lakip' => 7,
                'reviu_rkbmn' => 7,
                'evaluasi' => 2,
                'evaluasi_sakip' => 7,
                'evaluasi_rb' => 7,
                'evaluasi_maturitas_spip' => 7,
                'evaluasi_iacm' => 7,
                'pemantauan' => 2,
                'pemantauan_tl_bpk' => 7,
                'pemantauan_tl_lha' => 7,
                'pemantauan_spip' => 7,
                'pemantauan_lhkasn' => 7,
                'pengawasan_lainnya' => 2,
                'pengawasan_konsultasi' => 7,
                'pengawasan_sosialisasi' => 7,
                'pengawasan_asistensi' => 7,
                'pengawasan_rbzi' => 7,
                'pengawasan_sakip' => 7,
                'dokumentasi' => 2,
                'dokumentasi_pengajuan_nodin' => 6,
                'dokumentasi_pengajuan_kepsesjen' => 6,
                'dokumentasi_input_pkpt' => 6,
                'dokumentasi_input_notulen' => 6,
                'laporan' => 2,
                'laporan_hasil_audit' => 5,
                'laporan_hasil_kolom_audit' => 3,
                'laporan_hasil_laporan_audit' => 4,
                'laporan_hasil_download_audit' => 4,
                'laporan_hasil_reviu' => 5,
                'laporan_hasil_kolom_reviu' => 3,
                'laporan_hasil_laporan_reviu' => 4,
                'laporan_hasil_download_reviu' => 4,
                'laporan_hasil_evaluasi' => 5,
                'laporan_hasil_kolom_evaluasi' => 3,
                'laporan_hasil_laporan_evaluasi' => 4,
                'laporan_hasil_download_evaluasi' => 4,
                'laporan_hasil_pemantauan' => 5,
                'laporan_hasil_kolom_pemantauan' => 3,
                'laporan_hasil_laporan_pemantauan' => 4,
                'laporan_hasil_download_pemantauan' => 4,
                'laporan_hasil_pengawasan' => 5,
                'laporan_hasil_kolom_pengawasan' => 3,
                'laporan_hasil_laporan_pengawasan' => 4,
                'laporan_hasil_download_pengawasan' => 4,
                'laporan_hasil_notulen' => 5,
                'laporan_hasil_kolom_notulen' => 3,
                'laporan_hasil_laporan_notulen' => 4,
                'laporan_hasil_download_notulen' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            $checkid = DB::table('users')->where('nip', $request->nip)->first();
            
            DB::table('ketua_tim')->insert([
                'ketua' => $checkid->id,
                'pengendali_teknis' => $request->pt,
                'pengendali_mutu' => $request->pm,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $checkketua = DB::table('ketua_tim')
                          ->where('ketua', $checkid->id)
                          ->first();
            
            $group = DB::table('group')->insert([
                        'ketua' => $checkid->id,
                        'pengendali' => $checkketua->id
                     ]);
            $checkgroup = DB::table('group')
                      ->where('ketua', $checkid->id)
                      ->first();

            DB::table('users')->where('nip', $request->nip)->update([
                'group' => $checkgroup->id,
                'updated_at' => Carbon::now()
            ]);

        } elseif($request->level == 2)
        {
            $this->validate($request, [
            'ketua' => 'required'
           ]);
           
            $checkketua = DB::table('ketua_tim')
                          ->where('ketua', $request->ketua)
                          ->first();
            
            $group = DB::table('group')->insert([
                        'ketua' => $request->ketua,
                        'pengendali' => $checkketua->id
                ]);
            
            $checkgroup = DB::table('group')
                    ->where('ketua', $request->ketua)
                    ->first();

            DB::table('users')->insert([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'level' => $request->level,
                'is_active' => $request->is_active,
                'group' => $checkgroup->id,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('permission')->insert([
                'nip' => $request->nip,
                'dashboard' => 2,   
                'penyerapan' => 2,
                'penugasan' => 2,
                'user_admin' => 1,
                'audit' => 2,
                'audit_keuangan' => 7,
                'audit_kinerja' => 7,
                'audit_tujuan_tertentu' => 7,
                'reviu' => 2,
                'reviu_laporan_keuangan' => 7,
                'reviu_anggaran_kegiatan' => 7,
                'reviu_lakip' => 7,
                'reviu_rkbmn' => 7,
                'evaluasi' => 2,
                'evaluasi_sakip' => 7,
                'evaluasi_rb' => 7,
                'evaluasi_maturitas_spip' => 7,
                'evaluasi_iacm' => 7,
                'pemantauan' => 2,
                'pemantauan_tl_bpk' => 7,
                'pemantauan_tl_lha' => 7,
                'pemantauan_spip' => 7,
                'pemantauan_lhkasn' => 7,
                'pengawasan_lainnya' => 2,
                'pengawasan_konsultasi' => 7,
                'pengawasan_sosialisasi' => 7,
                'pengawasan_asistensi' => 7,
                'pengawasan_rbzi' => 7,
                'pengawasan_sakip' => 7,
                'dokumentasi' => 2,
                'dokumentasi_pengajuan_nodin' => 6,
                'dokumentasi_pengajuan_kepsesjen' => 6,
                'dokumentasi_input_pkpt' => 6,
                'dokumentasi_input_notulen' => 6,
                'laporan' => 2,
                'laporan_hasil_audit' => 5,
                'laporan_hasil_kolom_audit' => 3,
                'laporan_hasil_laporan_audit' => 4,
                'laporan_hasil_download_audit' => 4,
                'laporan_hasil_reviu' => 5,
                'laporan_hasil_kolom_reviu' => 3,
                'laporan_hasil_laporan_reviu' => 4,
                'laporan_hasil_download_reviu' => 4,
                'laporan_hasil_evaluasi' => 5,
                'laporan_hasil_kolom_evaluasi' => 3,
                'laporan_hasil_laporan_evaluasi' => 4,
                'laporan_hasil_download_evaluasi' => 4,
                'laporan_hasil_pemantauan' => 5,
                'laporan_hasil_kolom_pemantauan' => 3,
                'laporan_hasil_laporan_pemantauan' => 4,
                'laporan_hasil_download_pemantauan' => 4,
                'laporan_hasil_pengawasan' => 5,
                'laporan_hasil_kolom_pengawasan' => 3,
                'laporan_hasil_laporan_pengawasan' => 4,
                'laporan_hasil_download_pengawasan' => 4,
                'laporan_hasil_notulen' => 5,
                'laporan_hasil_kolom_notulen' => 3,
                'laporan_hasil_laporan_notulen' => 4,
                'laporan_hasil_download_notulen' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $checkuser = DB::table('users')->where('nip', $request->nip)->first();

            DB::table('anggota_tim')->insert([
                'ketua' => $request->ketua,
                'anggota' => $checkuser->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect(route('useradmin'))->with(['success' => 'Pesan Berhasil']);
        
        
        } else {

             DB::table('users')->insert([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'level' => $request->level,
                'is_active' => $request->is_active,
                'group' => 0,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if($request->level == 8) {
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 1,   
                    'penyerapan' => 1,
                    'penugasan' => 1,
                    'user_admin' => 8,
                    'audit' => 1,
                    'audit_keuangan' => 1,
                    'audit_kinerja' => 1,
                    'audit_tujuan_tertentu' => 1,
                    'reviu' => 1,
                    'reviu_laporan_keuangan' => 1,
                    'reviu_anggaran_kegiatan' => 1,
                    'reviu_lakip' => 1,
                    'reviu_rkbmn' => 1,
                    'evaluasi' => 1,
                    'evaluasi_sakip' => 1,
                    'evaluasi_rb' => 1,
                    'evaluasi_maturitas_spip' => 1,
                    'evaluasi_iacm' => 1,
                    'pemantauan' => 1,
                    'pemantauan_tl_bpk' => 1,
                    'pemantauan_tl_lha' => 1,
                    'pemantauan_spip' => 1,
                    'pemantauan_lhkasn' => 1,
                    'pengawasan_lainnya' => 1,
                    'pengawasan_konsultasi' => 1,
                    'pengawasan_sosialisasi' => 1,
                    'pengawasan_asistensi' => 1,
                    'pengawasan_rbzi' => 1,
                    'pengawasan_sakip' => 1,
                    'dokumentasi' => 1,
                    'dokumentasi_pengajuan_nodin' => 1,
                    'dokumentasi_pengajuan_kepsesjen' => 1,
                    'dokumentasi_input_pkpt' => 1,
                    'dokumentasi_input_notulen' => 1,
                    'laporan' => 1,
                    'laporan_hasil_audit' => 1,
                    'laporan_hasil_kolom_audit' => 1,
                    'laporan_hasil_laporan_audit' => 1,
                    'laporan_hasil_download_audit' => 1,
                    'laporan_hasil_reviu' => 1,
                    'laporan_hasil_kolom_reviu' => 1,
                    'laporan_hasil_laporan_reviu' => 1,
                    'laporan_hasil_download_reviu' => 1,
                    'laporan_hasil_evaluasi' => 1,
                    'laporan_hasil_kolom_evaluasi' => 1,
                    'laporan_hasil_laporan_evaluasi' => 1,
                    'laporan_hasil_download_evaluasi' => 1,
                    'laporan_hasil_pemantauan' => 1,
                    'laporan_hasil_kolom_pemantauan' => 1,
                    'laporan_hasil_laporan_pemantauan' => 1,
                    'laporan_hasil_download_pemantauan' => 1,
                    'laporan_hasil_pengawasan' => 1,
                    'laporan_hasil_kolom_pengawasan' => 1,
                    'laporan_hasil_laporan_pengawasan' => 1,
                    'laporan_hasil_download_pengawasan' => 1,
                    'laporan_hasil_notulen' => 1,
                    'laporan_hasil_kolom_notulen' => 1,
                    'laporan_hasil_laporan_notulen' => 1,
                    'laporan_hasil_download_notulen' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]); 
            } elseif($request->level == 7) {
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 1,   
                    'penyerapan' => 1,
                    'penugasan' => 1,
                    'user_admin' => 1,
                    'audit' => 1,
                    'audit_keuangan' => 1,
                    'audit_kinerja' => 1,
                    'audit_tujuan_tertentu' => 1,
                    'reviu' => 1,
                    'reviu_laporan_keuangan' => 1,
                    'reviu_anggaran_kegiatan' => 1,
                    'reviu_lakip' => 1,
                    'reviu_rkbmn' => 1,
                    'evaluasi' => 1,
                    'evaluasi_sakip' => 1,
                    'evaluasi_rb' => 1,
                    'evaluasi_maturitas_spip' => 1,
                    'evaluasi_iacm' => 1,
                    'pemantauan' => 1,
                    'pemantauan_tl_bpk' => 1,
                    'pemantauan_tl_lha' => 1,
                    'pemantauan_spip' => 1,
                    'pemantauan_lhkasn' => 1,
                    'pengawasan_lainnya' => 4,
                    'pengawasan_konsultasi' => 4,
                    'pengawasan_sosialisasi' => 4,
                    'pengawasan_asistensi' => 4,
                    'pengawasan_rbzi' => 4,
                    'pengawasan_sakip' => 4,
                    'dokumentasi' => 1,
                    'dokumentasi_pengajuan_nodin' => 1,
                    'dokumentasi_pengajuan_kepsesjen' => 1,
                    'dokumentasi_input_pkpt' => 1,
                    'dokumentasi_input_notulen' => 1,
                    'laporan' => 4,
                    'laporan_hasil_audit' => 4,
                    'laporan_hasil_kolom_audit' => 4,
                    'laporan_hasil_laporan_audit' => 4,
                    'laporan_hasil_download_audit' => 4,
                    'laporan_hasil_reviu' => 4,
                    'laporan_hasil_kolom_reviu' => 4,
                    'laporan_hasil_laporan_reviu' => 4,
                    'laporan_hasil_download_reviu' => 4,
                    'laporan_hasil_evaluasi' => 4,
                    'laporan_hasil_kolom_evaluasi' => 4,
                    'laporan_hasil_laporan_evaluasi' => 4,
                    'laporan_hasil_download_evaluasi' => 4,
                    'laporan_hasil_pemantauan' => 4,
                    'laporan_hasil_kolom_pemantauan' => 4,
                    'laporan_hasil_laporan_pemantauan' => 4,
                    'laporan_hasil_download_pemantauan' => 4,
                    'laporan_hasil_pengawasan' => 4,
                    'laporan_hasil_kolom_pengawasan' => 4,
                    'laporan_hasil_laporan_pengawasan' => 4,
                    'laporan_hasil_download_pengawasan' => 4,
                    'laporan_hasil_notulen' => 4,
                    'laporan_hasil_kolom_notulen' => 4,
                    'laporan_hasil_laporan_notulen' => 4,
                    'laporan_hasil_download_notulen' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->level == 6){
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 1,   
                    'penyerapan' => 1,
                    'penugasan' => 1,
                    'user_admin' => 1,
                    'audit' => 1,
                    'audit_keuangan' => 1,
                    'audit_kinerja' => 1,
                    'audit_tujuan_tertentu' => 1,
                    'reviu' => 1,
                    'reviu_laporan_keuangan' => 1,
                    'reviu_anggaran_kegiatan' => 1,
                    'reviu_lakip' => 1,
                    'reviu_rkbmn' => 1,
                    'evaluasi' => 1,
                    'evaluasi_sakip' => 1,
                    'evaluasi_rb' => 1,
                    'evaluasi_maturitas_spip' => 1,
                    'evaluasi_iacm' => 1,
                    'pemantauan' => 1,
                    'pemantauan_tl_bpk' => 1,
                    'pemantauan_tl_lha' => 1,
                    'pemantauan_spip' => 1,
                    'pemantauan_lhkasn' => 1,
                    'pengawasan_lainnya' => 7,
                    'pengawasan_konsultasi' => 7,
                    'pengawasan_sosialisasi' => 7,
                    'pengawasan_asistensi' => 7,
                    'pengawasan_rbzi' => 7,
                    'pengawasan_sakip' => 7,
                    'dokumentasi' => 1,
                    'dokumentasi_pengajuan_nodin' => 1,
                    'dokumentasi_pengajuan_kepsesjen' => 1,
                    'dokumentasi_input_pkpt' => 1,
                    'dokumentasi_input_notulen' => 1,
                    'laporan' => 1,
                    'laporan_hasil_audit' => 1,
                    'laporan_hasil_kolom_audit' => 1,
                    'laporan_hasil_laporan_audit' => 1,
                    'laporan_hasil_download_audit' => 1,
                    'laporan_hasil_reviu' => 1,
                    'laporan_hasil_kolom_reviu' => 1,
                    'laporan_hasil_laporan_reviu' => 1,
                    'laporan_hasil_download_reviu' => 1,
                    'laporan_hasil_evaluasi' => 1,
                    'laporan_hasil_kolom_evaluasi' => 1,
                    'laporan_hasil_laporan_evaluasi' => 1,
                    'laporan_hasil_download_evaluasi' => 1,
                    'laporan_hasil_pemantauan' => 1,
                    'laporan_hasil_kolom_pemantauan' => 1,
                    'laporan_hasil_laporan_pemantauan' => 1,
                    'laporan_hasil_download_pemantauan' => 1,
                    'laporan_hasil_pengawasan' => 1,
                    'laporan_hasil_kolom_pengawasan' => 1,
                    'laporan_hasil_laporan_pengawasan' => 1,
                    'laporan_hasil_download_pengawasan' => 1,
                    'laporan_hasil_notulen' => 1,
                    'laporan_hasil_kolom_notulen' => 1,
                    'laporan_hasil_laporan_notulen' => 1,
                    'laporan_hasil_download_notulen' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->level == 5){
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 1,   
                    'penyerapan' => 1,
                    'penugasan' => 1,
                    'user_admin' => 1,
                    'audit' => 1,
                    'audit_keuangan' => 1,
                    'audit_kinerja' => 1,
                    'audit_tujuan_tertentu' => 1,
                    'reviu' => 1,
                    'reviu_laporan_keuangan' => 1,
                    'reviu_anggaran_kegiatan' => 1,
                    'reviu_lakip' => 1,
                    'reviu_rkbmn' => 1,
                    'evaluasi' => 1,
                    'evaluasi_sakip' => 1,
                    'evaluasi_rb' => 1,
                    'evaluasi_maturitas_spip' => 1,
                    'evaluasi_iacm' => 1,
                    'pemantauan' => 1,
                    'pemantauan_tl_bpk' => 1,
                    'pemantauan_tl_lha' => 1,
                    'pemantauan_spip' => 1,
                    'pemantauan_lhkasn' => 1,
                    'pengawasan_lainnya' => 1,
                    'pengawasan_konsultasi' => 7,
                    'pengawasan_sosialisasi' => 7,
                    'pengawasan_asistensi' => 7,
                    'pengawasan_rbzi' => 7,
                    'pengawasan_sakip' => 7,
                    'dokumentasi' => 1,
                    'dokumentasi_pengajuan_nodin' => 1,
                    'dokumentasi_pengajuan_kepsesjen' => 1,
                    'dokumentasi_input_pkpt' => 1,
                    'dokumentasi_input_notulen' => 1,
                    'laporan' => 1,
                    'laporan_hasil_audit' => 1,
                    'laporan_hasil_kolom_audit' => 1,
                    'laporan_hasil_laporan_audit' => 4,
                    'laporan_hasil_download_audit' => 1,
                    'laporan_hasil_reviu' => 1,
                    'laporan_hasil_kolom_reviu' => 1,
                    'laporan_hasil_laporan_reviu' => 4,
                    'laporan_hasil_download_reviu' => 1,
                    'laporan_hasil_evaluasi' => 1,
                    'laporan_hasil_kolom_evaluasi' => 1,
                    'laporan_hasil_laporan_evaluasi' => 4,
                    'laporan_hasil_download_evaluasi' => 1,
                    'laporan_hasil_pemantauan' => 1,
                    'laporan_hasil_kolom_pemantauan' => 1,
                    'laporan_hasil_laporan_pemantauan' => 4,
                    'laporan_hasil_download_pemantauan' => 1,
                    'laporan_hasil_pengawasan' => 1,
                    'laporan_hasil_kolom_pengawasan' => 1,
                    'laporan_hasil_laporan_pengawasan' => 4,
                    'laporan_hasil_download_pengawasan' => 1,
                    'laporan_hasil_notulen' => 1,
                    'laporan_hasil_kolom_notulen' => 1,
                    'laporan_hasil_laporan_notulen' => 4,
                    'laporan_hasil_download_notulen' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->level == 4){
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 2,   
                    'penyerapan' => 2,
                    'penugasan' => 2,
                    'user_admin' => 1,
                    'audit' => 2,
                    'audit_keuangan' => 7,
                    'audit_kinerja' => 7,
                    'audit_tujuan_tertentu' => 7,
                    'reviu' => 2,
                    'reviu_laporan_keuangan' => 7,
                    'reviu_anggaran_kegiatan' => 7,
                    'reviu_lakip' => 7,
                    'reviu_rkbmn' => 7,
                    'evaluasi' => 2,
                    'evaluasi_sakip' => 7,
                    'evaluasi_rb' => 7,
                    'evaluasi_maturitas_spip' => 7,
                    'evaluasi_iacm' => 7,
                    'pemantauan' => 2,
                    'pemantauan_tl_bpk' => 7,
                    'pemantauan_tl_lha' => 7,
                    'pemantauan_spip' => 7,
                    'pemantauan_lhkasn' => 7,
                    'pengawasan_lainnya' => 2,
                    'pengawasan_konsultasi' => 7,
                    'pengawasan_sosialisasi' => 7,
                    'pengawasan_asistensi' => 7,
                    'pengawasan_rbzi' => 7,
                    'pengawasan_sakip' => 7,
                    'dokumentasi' => 2,
                    'dokumentasi_pengajuan_nodin' => 2,
                    'dokumentasi_pengajuan_kepsesjen' => 2,
                    'dokumentasi_input_pkpt' => 2,
                    'dokumentasi_input_notulen' => 2,
                    'laporan' => 2,
                    'laporan_hasil_audit' => 5,
                    'laporan_hasil_kolom_audit' => 1,
                    'laporan_hasil_laporan_audit' => 4,
                    'laporan_hasil_download_audit' => 4,
                    'laporan_hasil_reviu' => 5,
                    'laporan_hasil_kolom_reviu' => 2,
                    'laporan_hasil_laporan_reviu' => 4,
                    'laporan_hasil_download_reviu' => 4,
                    'laporan_hasil_evaluasi' => 5,
                    'laporan_hasil_kolom_evaluasi' => 2,
                    'laporan_hasil_laporan_evaluasi' => 4,
                    'laporan_hasil_download_evaluasi' => 4,
                    'laporan_hasil_pemantauan' => 5,
                    'laporan_hasil_kolom_pemantauan' => 2,
                    'laporan_hasil_laporan_pemantauan' => 4,
                    'laporan_hasil_download_pemantauan' => 4,
                    'laporan_hasil_pengawasan' => 5,
                    'laporan_hasil_kolom_pengawasan' => 2,
                    'laporan_hasil_laporan_pengawasan' => 4,
                    'laporan_hasil_download_pengawasan' => 4,
                    'laporan_hasil_notulen' => 5,
                    'laporan_hasil_kolom_notulen' => 2,
                    'laporan_hasil_laporan_notulen' => 4,
                    'laporan_hasil_download_notulen' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->level == 3){
                DB::table('permission')->insert([
                    'nip' => $request->nip,
                    'dashboard' => 2,   
                    'penyerapan' => 2,
                    'penugasan' => 2,
                    'user_admin' => 1,
                    'audit' => 2,
                    'audit_keuangan' => 7,
                    'audit_kinerja' => 7,
                    'audit_tujuan_tertentu' => 7,
                    'reviu' => 2,
                    'reviu_laporan_keuangan' => 7,
                    'reviu_anggaran_kegiatan' => 7,
                    'reviu_lakip' => 7,
                    'reviu_rkbmn' => 7,
                    'evaluasi' => 2,
                    'evaluasi_sakip' => 7,
                    'evaluasi_rb' => 7,
                    'evaluasi_maturitas_spip' => 7,
                    'evaluasi_iacm' => 7,
                    'pemantauan' => 2,
                    'pemantauan_tl_bpk' => 7,
                    'pemantauan_tl_lha' => 7,
                    'pemantauan_spip' => 7,
                    'pemantauan_lhkasn' => 7,
                    'pengawasan_lainnya' => 2,
                    'pengawasan_konsultasi' => 7,
                    'pengawasan_sosialisasi' => 7,
                    'pengawasan_asistensi' => 7,
                    'pengawasan_rbzi' => 7,
                    'pengawasan_sakip' => 7,
                    'dokumentasi' => 2,
                    'dokumentasi_pengajuan_nodin' => 2,
                    'dokumentasi_pengajuan_kepsesjen' => 2,
                    'dokumentasi_input_pkpt' => 2,
                    'dokumentasi_input_notulen' => 2,
                    'laporan' => 2,
                    'laporan_hasil_audit' => 5,
                    'laporan_hasil_kolom_audit' => 1,
                    'laporan_hasil_laporan_audit' => 4,
                    'laporan_hasil_download_audit' => 4,
                    'laporan_hasil_reviu' => 5,
                    'laporan_hasil_kolom_reviu' => 2,
                    'laporan_hasil_laporan_reviu' => 4,
                    'laporan_hasil_download_reviu' => 4,
                    'laporan_hasil_evaluasi' => 5,
                    'laporan_hasil_kolom_evaluasi' => 2,
                    'laporan_hasil_laporan_evaluasi' => 4,
                    'laporan_hasil_download_evaluasi' => 4,
                    'laporan_hasil_pemantauan' => 5,
                    'laporan_hasil_kolom_pemantauan' => 2,
                    'laporan_hasil_laporan_pemantauan' => 4,
                    'laporan_hasil_download_pemantauan' => 4,
                    'laporan_hasil_pengawasan' => 5,
                    'laporan_hasil_kolom_pengawasan' => 2,
                    'laporan_hasil_laporan_pengawasan' => 4,
                    'laporan_hasil_download_pengawasan' => 4,
                    'laporan_hasil_notulen' => 5,
                    'laporan_hasil_kolom_notulen' => 2,
                    'laporan_hasil_laporan_notulen' => 4,
                    'laporan_hasil_download_notulen' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } else {

            }
        }

         return redirect(route('useradmin'))->with(['success' => 'Pesan Berhasil']);
    }

    public function detail($id)
    {

        $jabatan = DB::table('jabatan')->get();
        $level = DB::table('level')->get();
        $users = DB::table('users as u')
                ->where('id', $id)
                ->first();
        $ketua_tim = DB::table('anggota_tim as at')
                      ->select('at.*', 'u.nama as ketua', 'u.id as id_users')
                      ->join('users as u', 'u.id', '=', 'at.ketua')
                      ->where('anggota', $id)
                      ->first();     
        $pengendali = DB::table('ketua_tim as kt')
                      ->select('kt.*', 'pt.nama as pengendali_teknis', 'pm.nama as pengendali_mutu', 'pt.id as id_teknis', 'pm.id as id_mutu')
                      ->join('users as pt', 'pt.id', '=', 'kt.pengendali_teknis')
                      ->leftjoin('users as pm', 'pm.id', '=', 'kt.pengendali_mutu')
                      ->where('ketua', $id)
                      ->first();
        $group = DB::table('group as g')
                 ->select('g.*', 'p.pengendali_teknis', 'p.pengendali_mutu')
                 ->where('g.id', $users->group)
                 ->join('ketua_tim as p', 'p.ketua', '=', 'g.ketua')
                 ->first();
        $ketua = DB::table('users')
                 ->where('level', 1)
                ->get();
        $pt = DB::table('users')
              ->where('level', 3)
              ->get();
        $pm = DB::table('users')
              ->where('level', 4)
              ->get();
        
        if($group == null) {
            $anggota = null;
        } else {
            $anggota = DB::table('anggota_tim as at')
                   ->select('at.*', 'u.nama as anggota')
                   ->where('at.ketua', $group->ketua)
                   ->join('users as u', 'u.id', '=', 'at.anggota')
                   ->get();
        }

        $menu = DB::table('permission')
                ->where('nip', $users->nip)
                ->first();

        $submenu = DB::table('submenu')->get();
      
        $page = "useradmin";
        return view('partial.useradmin.detail', compact('page', 'level', 'jabatan', 'users', 'menu', 'submenu', 'ketua_tim', 'pengendali', 'ketua', 'pt', 'pm'));
    }

    public function ubah(Request $request, $id)
    {

        $data = DB::table('users')->where('id', $id)->first();

        if ($request->has('jabatan') && $request['jabatan']!=null) {
            DB::table('users')->where('id', $id)->update([
            'jabatan' => $request['jabatan'],
            'updated_at' => Carbon::now()
            ]);
        }

        if ($request->has('is_active') && $request['is_active']!=null) {
            DB::table('users')->where('id', $id)->update([
            'is_active' => $request['is_active'],
            'updated_at' => Carbon::now()
            ]);
        }

        $user = DB::table('users')->where('id', $id)->first();

        if ($request->has('penyerapan') && $request['penyerapan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'penyerapan' => $request['penyerapan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('penugasan') && $request['penugasan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'penugasan' => $request['penugasan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('user_admin') && $request['user_admin']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'user_admin' => $request['user_admin'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('audit_keuangan') && $request['audit_keuangan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'audit_keuangan' => $request['audit_keuangan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('audit_kinerja') && $request['audit_kinerja']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'audit_kinerja' => $request['audit_kinerja'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('audit_tujuan_tertentu') && $request['audit_tujuan_tertentu']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'audit_tujuan_tertentu' => $request['audit_tujuan_tertentu'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('reviu_laporan_keuangan') && $request['reviu_laporan_keuangan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'reviu_laporan_keuangan' => $request['reviu_laporan_keuangan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('reviu_anggaran_kegiatan') && $request['reviu_anggaran_kegiatan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'reviu_anggaran_kegiatan' => $request['reviu_anggaran_kegiatan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('reviu_lakip') && $request['reviu_lakip']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'reviu_lakip' => $request['reviu_lakip'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('reviu_rkbmn') && $request['reviu_rkbmn']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'reviu_rkbmn' => $request['reviu_rkbmn'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('evaluasi_sakip') && $request['evaluasi_sakip']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'evaluasi_sakip' => $request['evaluasi_sakip'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('evaluasi_rb') && $request['evaluasi_rb']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'evaluasi_rb' => $request['evaluasi_rb'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('evaluasi_maturitas_spip') && $request['evaluasi_maturitas_spip']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'evaluasi_maturitas_spip' => $request['evaluasi_maturitas_spip'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('evaluasi_iacm') && $request['evaluasi_iacm']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'evaluasi_iacm' => $request['evaluasi_iacm'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pemantauan_tl_bpk') && $request['pemantauan_tl_bpk']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pemantauan_tl_bpk' => $request['pemantauan_tl_bpk'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pemantauan_tl_lha') && $request['pemantauan_tl_lha']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pemantauan_tl_lha' => $request['pemantauan_tl_lha'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pemantauan_spip') && $request['pemantauan_spip']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pemantauan_spip' => $request['pemantauan_spip'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pemantauan_lhkasn') && $request['pemantauan_lhkasn']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pemantauan_lhkasn' => $request['pemantauan_lhkasn'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pengawasan_konsultasi') && $request['pengawasan_konsultasi']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pengawasan_konsultasi' => $request['pengawasan_konsultasi'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pengawasan_sosialisasi') && $request['pengawasan_sosialisasi']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pengawasan_sosialisasi' => $request['pengawasan_sosialisasi'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pengawasan_asistensi') && $request['pengawasan_asistensi']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pengawasan_asistensi' => $request['pengawasan_asistensi'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pengawasan_rbzi') && $request['pengawasan_rbzi']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pengawasan_rbzi' => $request['pengawasan_rbzi'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('pengawasan_sakip') && $request['pengawasan_sakip']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'pengawasan_sakip' => $request['pengawasan_sakip'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('dokumentasi_pengajuan_nodin') && $request['dokumentasi_pengajuan_nodin']!=null) {
            DB::table('permission')->where('id', $id)->update([
            'dokumentasi_pengajuan_nodin' => $request['dokumentasi_pengajuan_nodin'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('dokumentasi_pengajuan_kepsesjen') && $request['dokumentasi_pengajuan_kepsesjen']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'dokumentasi_pengajuan_kepsesjen' => $request['dokumentasi_pengajuan_kepsesjen'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('dokumentasi_input_pkpt') && $request['dokumentasi_input_pkpt']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'dokumentasi_input_pkpt' => $request['dokumentasi_input_pkpt'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('dokumentasi_input_notulen') && $request['dokumentasi_input_notulen']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'dokumentasi_input_notulen' => $request['dokumentasi_input_notulen'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_audit') && $request['laporan_hasil_audit']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_audit' => $request['laporan_hasil_audit'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_reviu') && $request['laporan_hasil_reviu']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_reviu' => $request['laporan_hasil_reviu'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_evaluasi') && $request['laporan_hasil_evaluasi']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_evaluasi' => $request['laporan_hasil_evaluasi'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_pemantauan') && $request['laporan_hasil_pemantauan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_pemantauan' => $request['laporan_hasil_pemantauan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_pengawasan') && $request['laporan_hasil_pengawasan']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_pengawasan' => $request['laporan_hasil_pengawasan'],
            'updated_at' => Carbon::now()
            ]);
        }
        if ($request->has('laporan_hasil_notulen') && $request['laporan_hasil_notulen']!=null) {
            DB::table('permission')->where('nip', $user->nip)->update([
            'laporan_hasil_notulen' => $request['laporan_hasil_notulen'],
            'updated_at' => Carbon::now()
            ]);
        }

         return redirect()->route('ubah.useradmin', ['id' => $id])->with(['success' => 'Pesan Berhasil']);
    }

}