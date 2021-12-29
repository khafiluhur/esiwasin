<?php

namespace App\Http\Controllers\Dashboard;

use DB; 
use Auth;
use File;
use Carbon\Carbon;
use App\KertasEvaluasiIacm;
use App\KertasEvaluasiSpip;
use App\KertasEvaluasiSakip;
use Illuminate\Http\Request;
use App\KertasEvaluasiReformasi;
use App\Http\Controllers\Controller;

class EvaluasiController extends Controller
{

    public function index()
    {
        $ketua = DB::table('users')
                ->select('users.id', 'users.nama')
                ->where('users.group', '=', Auth::user()->group)
                ->where('users.level', '=', 1)
                ->get();

        $anggota = DB::table('users')
                ->get(); 
                
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $pkpt_sakip = DB::table('input_pkpt')->where('jenis', 8)->get();
        $pkpt_rb = DB::table('input_pkpt')->where('jenis', 9)->get();
        $pkpt_spip = DB::table('input_pkpt')->where('jenis', 10)->get();
        $pkpt_iacm = DB::table('input_pkpt')->where('jenis', 11)->get();
        
        ## Evaluasi SAKIP ##
        $data1 = DB::table('evaluasi_sakip as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'uk.nama as users_ketua', 
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.nama as status_pt', 
                    'aak.tanggal_pt',
                    'aak.jam_pt',
                    'aak.komentar_pt',
                    'aak.users_pm as id_pm',
                    'upm.nama as users_pm', 
                    'spm.nama as status_pm', 
                    'aak.tanggal_pm',
                    'aak.jam_pm',
                    'aak.komentar_pm')
                ->join('approvel_evaluasi_sakip as aak', 'aak.evaluasi_sakip', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first(); 
        if($data1) {
            $file1 = DB::table('kertas_evaluasi_sakips')
                ->where('kode_evaluasi_sakip', $data1->kode)
                ->get();
        }else {
            $file1 = null;
        }

        ## Evaluasi Reformasi Birokrasi ##
        $data2 = DB::table('evaluasi_reformasi_birokrasi as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'uk.nama as users_ketua', 
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.nama as status_pt', 
                    'aak.tanggal_pt',
                    'aak.jam_pt',
                    'aak.komentar_pt',
                    'aak.users_pm as id_pm',
                    'upm.nama as users_pm', 
                    'spm.nama as status_pm', 
                    'aak.tanggal_pm',
                    'aak.jam_pm',
                    'aak.komentar_pm')
                ->join('approvel_evaluasi_reformasi_birokrasi as aak', 'aak.evaluasi_reformasi_birokrasi', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();
        if($data2) {
            $file2 = DB::table('kertas_evaluasi_reformasis')
                ->where('kode_evaluasi_reformasi', $data2->kode)
                ->get();
        }else {
            $file2 = null;
        } 

        ## Evaluasi Reformasi Birokrasi ##
        $data3 = DB::table('evaluasi_spip as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'uk.nama as users_ketua', 
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.nama as status_pt', 
                    'aak.tanggal_pt',
                    'aak.jam_pt',
                    'aak.komentar_pt',
                    'aak.users_pm as id_pm',
                    'upm.nama as users_pm', 
                    'spm.nama as status_pm', 
                    'aak.tanggal_pm',
                    'aak.jam_pm',
                    'aak.komentar_pm')
                ->join('approvel_evaluasi_spip as aak', 'aak.evaluasi_spip', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();
        if($data3) {
            $file3 = DB::table('kertas_evaluasi_spips')
                ->where('kode_evaluasi_spip', $data3->kode)
                ->get();
        }else {
            $file3 = null;
        } 

        ## Evaluasi IACM ##
        $data4 = DB::table('evaluasi_iacm as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'uk.nama as users_ketua', 
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.nama as status_pt', 
                    'aak.tanggal_pt',
                    'aak.jam_pt',
                    'aak.komentar_pt',
                    'aak.users_pm as id_pm',
                    'upm.nama as users_pm', 
                    'spm.nama as status_pm', 
                    'aak.tanggal_pm',
                    'aak.jam_pm',
                    'aak.komentar_pm')
                ->join('approvel_evaluasi_iacm as aak', 'aak.evaluasi_iacm', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();
        if($data4) {
            $file4 = DB::table('kertas_evaluasi_iacms')
                ->where('kode_evaluasi_iacm', $data4->kode)
                ->get();
        }else {
            $file4 = null;
        } 

        $page = "evaluasi"; 
        return view('dashboard.evaluasi',compact('page', 'pkpt_sakip', 'pkpt_rb', 'pkpt_spip', 'pkpt_iacm', 'ketua', 'data1', 'file1', 'data2', 'file2', 'data3', 'file3', 'data4', 'file4', 'anggota', 'permission'));
    }

    ## Evaluasi SAKIP ##
    public function post1(Request $request)
    {
        $checkdata = DB::table('evaluasi_sakip')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/sakip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSakip::create([
                            'kode_evaluasi_sakip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_sakip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('evaluasi_sakip')
                        ->select('kode')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_evaluasi_sakip')->insert([
                    'evaluasi_sakip' => $data->kode,
                    'users_pembuat' => Auth::user()->id,
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'users_ketua' => $request->ketua,
                    'status_ketua' => 0,
                    'tanggal_ketua' => 0,
                    'jam_ketua' => 0,
                    'komentar_ketua' => 0,
                    'users_pt' => 0,
                    'status_pt' => 0,
                    'tanggal_pt' => 0,
                    'jam_pt' => 0,
                    'komentar_pt' => 0,
                    'users_pm' => 0,
                    'status_pm' => 0,
                    'tanggal_pm' => 0,
                    'jam_pm' => 0,
                    'komentar_pm' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->insert([
                    'created_by' => Auth::user()->id,
                    'evaluasi' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                 $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/sakip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSakip::create([
                            'kode_evaluasi_sakip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_sakip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 0,
                    'is_save' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        } else {
            if($request->has('kirim')) {
                $datacheck = DB::table('evaluasi_sakip')
                ->where('kode', $request->kode)
                ->first();

            $this->validate($request, 
            [
                'komentar' => 'required',
            ]);
            
            if($request->kertas_kerja == null) {
            } else {
            foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/evaluasi/sakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasEvaluasiSakip::create([
                        'kode_evaluasi_sakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }
            }

            DB::table('evaluasi_sakip')->where('kode', $request->kode)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                'temuan_penjelasan' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_publish' => 1,
                'updated_at' => Carbon::now()
                ]); 

            DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                'status_pembuat' => 1,
                'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                'jam_pembuat' => Carbon::now()->format('H:m'),
                'komentar_pembuat' => $request->komentar,
                'updated_at' => Carbon::now()
            ]);

            DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

            DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                'is_prosess' => 1,
                'jenis' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            } elseif($request->has('simpan')) {
            
            if($request->kertas_kerja == null) {
            } else {
            foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/evaluasi/sakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasEvaluasiSakip::create([
                        'kode_evaluasi_sakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }
            }

            DB::table('evaluasi_sakip')->where('kode', $request->kode)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                'temuan_penjelasan' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_save' => 1,
                'updated_at' => Carbon::now()
                ]);
            }

            DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            
        };          
                
        return redirect(route('evaluasi').'#evaluasi_sakip')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve1(Request $request)
    {
        $data =  DB::table('approvel_evaluasi_sakip as auk')
                ->where('auk.evaluasi_sakip', $request->kode)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->evaluasi_sakip == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    $checkUserPt = DB::table('users')->where('level','=',3)->where('is_active','=',1)->first();
                    $checkUserPm = DB::table('users')->where('level','=',4)->where('is_active','=',1)->first();
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'users_pt' => $checkUserPt->id,
                    'users_pm' => $checkUserPm->id,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pt' => 2,
                    'users_pt' => Auth::user()->id,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pm' => 2,
                    'users_pm' => Auth::user()->id,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_sakip')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->evaluasi_sakip == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_sakip')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_evaluasi_sakip')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_sakip')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SAKIP Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete1($id)
    {
        $gambar = DB::table('kertas_evaluasi_sakips')->where('id',$id)->first();
	    File::delete('storage/upload/evaluasi/sakip/'.$gambar->filename);
        DB::table('kertas_evaluasi_sakips')->where('id', $id)->delete();
        return redirect(route('evaluasi'))->with(['success' => 'Kertas Kerja Evaluasi SAKIP Berhasil di Hapus']);      
    }

    ## Evaluasi Reformasi Birokrasi ##
    public function post2(Request $request)
    {
        $checkdata = DB::table('evaluasi_reformasi_birokrasi')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/reformasi';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiReformasi::create([
                            'kode_evaluasi_reformasi' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_reformasi_birokrasi')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('evaluasi_reformasi_birokrasi')
                        ->select('kode')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_evaluasi_reformasi_birokrasi')->insert([
                    'evaluasi_reformasi_birokrasi' => $data->kode,
                    'users_pembuat' => Auth::user()->id,
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'users_ketua' => $request->ketua,
                    'status_ketua' => 0,
                    'tanggal_ketua' => 0,
                    'jam_ketua' => 0,
                    'komentar_ketua' => 0,
                    'users_pt' => 0,
                    'status_pt' => 0,
                    'tanggal_pt' => 0,
                    'jam_pt' => 0,
                    'komentar_pt' => 0,
                    'users_pm' => 0,
                    'status_pm' => 0,
                    'tanggal_pm' => 0,
                    'jam_pm' => 0,
                    'komentar_pm' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->insert([
                    'created_by' => Auth::user()->id,
                    'evaluasi' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                   $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/reformasi';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiReformasi::create([
                            'kode_evaluasi_reformasi' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_reformasi_birokrasi')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 0,
                    'is_save' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        } else {
            if($request->has('kirim')) {

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/reformasi';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiReformasi::create([
                            'kode_evaluasi_reformasi' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_reformasi_birokrasi')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_reformasi_birokrasi', $request->id)->update([
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                $datacheck = DB::table('evaluasi_reformasi_birokrasi')
                ->where('kode', $request->kode)
                ->first();
                
                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/reformasi';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiReformasi::create([
                            'kode_evaluasi_reformasi' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_reformasi_birokrasi')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_save' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        };          
                
        return redirect(route('evaluasi').'#evaluasi_reformasi_birokrasi')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve2(Request $request)
    {
        $data =  DB::table('approvel_evaluasi_reformasi_birokrasi as auk')
                ->where('auk.evaluasi_reformasi_birokrasi', $request->kdoe)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->evaluasi_reformasi_birokrasi == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    $checkUserPt = DB::table('users')->where('level','=',3)->where('is_active','=',1)->first();
                    $checkUserPm = DB::table('users')->where('level','=',4)->where('is_active','=',1)->first();
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_reformasi_birokrasi', $request->kode)->update([
                    'users_pt' => $checkUserPt->id,
                    'users_pm' => $checkUserPm->id,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pt' => 2,
                    'users_pt' => Auth::user()->id,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_sakip', $request->kode)->update([
                    'status_pm' => 2,
                    'users_pm' => Auth::user()->id,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_reformasi_birokrasi')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->evaluasi_reformasi_birokrasi == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_reformasi_birokrasi', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_reformasi_birokrasi')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_reformasi_birokrasi', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_evaluasi_reformasi_birokrasi')->where('evaluasi_reformasi_birokrasi', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_reformasi_birokrasi')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi Reformasi Birokrasi Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete2($id)
    {
        $gambar = DB::table('kertas_evaluasi_reformasis')->where('id',$id)->first();
	    File::delete('storage/upload/evaluasi/reformasi/'.$gambar->filename);
        DB::table('kertas_evaluasi_reformasis')->where('id', $id)->delete();
        return redirect(route('evaluasi'))->with(['success' => 'Kertas Kerja Evaluasi Reformasi Birokrasi Berhasil di Hapus']);      
    }


    ## Evaluasi Maturitas SPIP ##
    public function post3(Request $request)
    {
        $checkdata = DB::table('evaluasi_spip')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/spip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSpip::create([
                            'kode_evaluasi_spip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_spip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('evaluasi_spip')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_evaluasi_spip')->insert([
                    'evaluasi_spip' => $data->kode,
                    'users_pembuat' => Auth::user()->id,
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'users_ketua' => $request->ketua,
                    'status_ketua' => 0,
                    'tanggal_ketua' => 0,
                    'jam_ketua' => 0,
                    'komentar_ketua' => 0,
                    'users_pt' => 0,
                    'status_pt' => 0,
                    'tanggal_pt' => 0,
                    'jam_pt' => 0,
                    'komentar_pt' => 0,
                    'users_pm' => 0,
                    'status_pm' => 0,
                    'tanggal_pm' => 0,
                    'jam_pm' => 0,
                    'komentar_pm' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->insert([
                    'created_by' => Auth::user()->id,
                    'evaluasi' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                   $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/spip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSpip::create([
                            'kode_evaluasi_spip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_spip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 0,
                    'is_save' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        } else {
            if($request->has('kirim')) {

                $datacheck = DB::table('evaluasi_spip')
                ->where('kdoe', $request->kode)
                ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/spip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSpip::create([
                            'kode_evaluasi_spip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_spip')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                    'is_prosess' => 1,
                    'jenis' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/spip';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiSpip::create([
                            'kode_evaluasi_spip' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_spip')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_save' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        };          
                
        return redirect(route('evaluasi').'#evaluasi_spip')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve3(Request $request)
    {
        $data =  DB::table('approvel_evaluasi_spip as auk')
                ->where('auk.evaluasi_spip', $request->kode)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->evaluasi_spip == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    $checkUserPt = DB::table('users')->where('level','=',3)->where('is_active','=',1)->first();
                    $checkUserPm = DB::table('users')->where('level','=',4)->where('is_active','=',1)->first();
                    DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'users_pt' => $checkUserPt->id,
                    'users_pm' => $checkUserPm->id,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_pt' => 2,
                    'users_pt' => Auth::user()->id,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_pm' => 2,
                    'users_pm' => Auth::user()->id,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_evaluasi_spip')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->evaluasi_spip == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_spip')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_evaluasi_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_evaluasi_spip')->where('evaluasi_spip', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_spip')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi SPIP Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete3($id)
    {
        $gambar = DB::table('kertas_evaluasi_spips')->where('id',$id)->first();
	    File::delete('storage/upload/evaluasi/spip/'.$gambar->filename);
        DB::table('kertas_evaluasi_spips')->where('id', $id)->delete();
        return redirect(route('evaluasi'))->with(['success' => 'Kertas Kerja Maturitas SPIP Berhasil di Hapus']);      
    }

        ## Evaluasi IACM ##
    public function post4(Request $request)
    {
        $checkdata = DB::table('evaluasi_iacm')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/iacm';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiIacm::create([
                            'kode_evaluasi_iacm' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_iacm')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('evaluasi_iacm')
                        ->select('kode')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_evaluasi_iacm')->insert([
                    'evaluasi_iacm' => $data->kode,
                    'users_pembuat' => Auth::user()->id,
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'users_ketua' => $request->ketua,
                    'status_ketua' => 0,
                    'tanggal_ketua' => 0,
                    'jam_ketua' => 0,
                    'komentar_ketua' => 0,
                    'users_pt' => 0,
                    'status_pt' => 0,
                    'tanggal_pt' => 0,
                    'jam_pt' => 0,
                    'komentar_pt' => 0,
                    'users_pm' => 0,
                    'status_pm' => 0,
                    'tanggal_pm' => 0,
                    'jam_pm' => 0,
                    'komentar_pm' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->insert([
                    'created_by' => Auth::user()->id,
                    'evaluasi' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/iacm';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiIacm::create([
                            'kode_evaluasi_iacm' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_iacm')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 0,
                    'is_save' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        } else {
            if($request->has('kirim')) {

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/iacm';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiIacm::create([
                            'kode_evaluasi_iacm' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_iacm')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                    'is_prosess' => 1,
                    'jenis' => 4,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {

                if($request->kertas_kerja == null) {
                } else {
                    foreach ($request->kertas_kerja as $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                        $folder = 'storage/upload/evaluasi/iacm';
                        $photopath = $folder.$photoname;
                        $photo->move(public_path($folder),$photoname);
                        $data[] = $photoname;
                        KertasEvaluasiIacm::create([
                            'kode_evaluasi_iacm' => $request->kode,
                            'filename' => $photoname
                        ]);
                    }
                }

                DB::table('evaluasi_iacm')->where('kode', $request->kode)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_evaluasi_from' => $request->tanggal_audit_from,
                    'tanggal_evaluasi_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_save' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        };          
                
        return redirect(route('evaluasi').'#evaluasi_iacm')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve4(Request $request)
    {
        $data =  DB::table('approvel_evaluasi_iacm as auk')
                ->where('auk.evaluasi_iacm', $request->kode)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->evaluasi_iacm == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    $checkUserPt = DB::table('users')->where('level','=',3)->where('is_active','=',1)->first();
                    $checkUserPm = DB::table('users')->where('level','=',4)->where('is_active','=',1)->first();
                    DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'users_pt' => $checkUserPt->id,
                    'users_pm' => $checkUserPm->id,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_pt' => 2,
                    'users_pt' => Auth::user()->id,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1) {
                    DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_pm' => 2,
                    'users_pm' => Auth::user()->id,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_evaluasi_iacm')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->evaluasi_iacm == $request->kode) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_iacm')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_evaluasi_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_evaluasi_iacm')->where('evaluasi_iacm', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi')->where('evaluasi', $request->kode)->update([
                        'is_prosess' => 2,
                        'jenis' => 4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('evaluasi_iacm')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('evaluasi'))->with(['success' => 'Evaluasi IACM Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete4($id)
    {
        $gambar = DB::table('kertas_evaluasi_iacms')->where('id',$id)->first();
	    File::delete('storage/upload/evaluasi/iacm/'.$gambar->filename);
        DB::table('kertas_evaluasi_iacms')->where('id', $id)->delete();
        return redirect(route('evaluasi'))->with(['success' => 'Kertas Kerja Evluasi IACM Berhasil di Hapus']);      
    }
}
