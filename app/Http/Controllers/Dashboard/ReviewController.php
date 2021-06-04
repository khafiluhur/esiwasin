<?php

namespace App\Http\Controllers\Dashboard;

use DB; 
use Auth;
use File;
use Carbon\Carbon;
use App\KertasReviuKeuangan;
use App\KertasReviuAnggaran;
use App\KertasReviuLakip;
use App\KertasReviuRkbmn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
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

        $pkpt_keuangan = DB::table('input_pkpt')->where('jenis', 4)->get();
        $pkpt_anggaran = DB::table('input_pkpt')->where('jenis', 5)->get();
        $pkpt_lakip = DB::table('input_pkpt')->where('jenis', 6)->get();
        $pkpt_rkbmn = DB::table('input_pkpt')->where('jenis', 7)->get();
        
        ## Reviu Laporan Keuangan ##
        $data1 = DB::table('reviu_laporan_keuangan as ak')
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
                ->join('approvel_reviu_laporan_keuangan as aak', 'aak.reviu_laporan_keuangan', '=', 'ak.id')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('created_at')
                ->first(); 
        // dd($data1);
        if($data1) {
            $file1 = DB::table('kertas_reviu_keuangans')
                ->where('kode_reviu_keuangan', $data1->kode)
                ->get();
        }else {
            $file1 = null;
        }
                
        ## Reviu Kegiatan Anggaran ##
        $data2 = DB::table('reviu_kegiatan_anggaran as ak')
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
                ->join('approvel_reviu_kegiatan_anggaran as aak', 'aak.reviu_kegiatan_anggaran', '=', 'ak.id')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('created_at')
                ->first(); 
        // dd($data2);
        if($data2) {
            $file2 = DB::table('kertas_reviu_anggarans')
                ->where('kode_reviu_anggaran', $data2->kode)
                ->get();
        }else {
            $file2 = null;
        }

        ## Reviu LAKIP ##
        $data3 = DB::table('reviu_lakip as ak')
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
                ->join('approvel_reviu_lakip as aak', 'aak.reviu_lakip', '=', 'ak.id')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('created_at')
                ->first(); 
        if($data3) {
            $file3 = DB::table('kertas_reviu_lakips')
                ->where('kode_reviu_lakip', $data3->kode)
                ->get();
        }else {
            $file3 = null;
        }

        ## Reviu RKBMN ##
        $data4 = DB::table('reviu_rkbmn as ak')
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
                ->join('approvel_reviu_rkbmn as aak', 'aak.reviu_rkbmn', '=', 'ak.id')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('created_at')
                ->first(); 
        if($data4) {
            $file4 = DB::table('kertas_reviu_rkbmns')
                ->where('kode_reviu_rkbmn', $data4->kode)
                ->get();
        }else {
            $file4 = null;
        }

        $page = "review"; 
        return view('dashboard.review', compact('page', 'pkpt_keuangan', 'pkpt_anggaran', 'pkpt_lakip', 'pkpt_rkbmn', 'ketua', 'data1', 'file1', 'data2', 'file2', 'data3', 'file3', 'data4', 'file4', 'anggota', 'permission'));
    }

    ## Reviu Laporan Keuangan ##
    public function post1(Request $request)
    {
        $checkdata = DB::table('reviu_laporan_keuangan')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_sebab' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuKeuangan::create([
                        'kode_reviu_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_laporan_keuangan')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_sebab,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('reviu_laporan_keuangan')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_reviu_laporan_keuangan')->insert([
                    'reviu_laporan_keuangan' => $data->id,
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

                DB::table('reviu')->insert([
                    'created_by' => Auth::user()->id,
                    'reviu' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif ($request->has('simpan')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_to' => 'required',
                'temuan_sebab' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuKeuangan::create([
                        'kode_reviu_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_laporan_keuangan')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_sebab,
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
                $datacheck = DB::table('reviu_laporan_keuangan')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuKeuangan::create([
                        'kode_reviu_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_laporan_keuangan')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
                'is_prosess' => 1,
                'is_status' => 1,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
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

                DB::table('reviu')->where('reviu', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                $datacheck = DB::table('reviu_laporan_keuangan')
                    ->where('id', $request->id)
                    ->first();
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuKeuangan::create([
                        'kode_reviu_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_laporan_keuangan')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
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
                
        return redirect(route('reviu').'#reviu_laporan_keuangan')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve1(Request $request)
    {
        $data =  DB::table('approvel_reviu_laporan_keuangan as auk')
                ->where('auk.reviu_laporan_keuangan', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->reviu_laporan_keuangan == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_laporan_keuangan')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->reviu_laporan_keuangan == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_laporan_keuangan')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_laporan_keuangan')->where('reviu_laporan_keuangan', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_laporan_keuangan')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Laporan Keuangan Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete1($id)
    {
        $gambar = DB::table('kertas_reviu_keuangans')->where('id',$id)->first();
	    File::delete('storage/upload/reviu/keuangan/'.$gambar->filename);
        DB::table('kertas_reviu_keuangans')->where('id', $id)->delete();
        return redirect(route('reviu'))->with(['success' => 'Kertas Kerja Reviu Laporan Keuangan Berhasil di Hapus']);      
    }

    ## Reviu Kegiatan Anggaran ##
    public function post2(Request $request)
    {
        $checkdata = DB::table('reviu_kegiatan_anggaran')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

               foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/anggaran';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuAnggaran::create([
                        'kode_reviu_anggaran' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_kegiatan_anggaran')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('reviu_kegiatan_anggaran')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_reviu_kegiatan_anggaran')->insert([
                    'reviu_kegiatan_anggaran' => $data->id,
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

                DB::table('reviu')->insert([
                    'created_by' => Auth::user()->id,
                    'reviu' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
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
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/anggaran';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuAnggaran::create([
                        'kode_reviu_anggaran' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_kegiatan_anggaran')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
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
                $datacheck = DB::table('reviu_kegiatan_anggaran')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/anggaran';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuAnggaran::create([
                        'kode_reviu_anggaran' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_kegiatan_anggaran')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_publish' => 1,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
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

                DB::table('reviu')->where('reviu', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/anggaran';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuAnggaran::create([
                        'kode_reviu_anggaran' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_kegiatan_anggaran')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
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
                
        return redirect(route('reviu').'#reviu_kegiatan_anggaran')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve2(Request $request)
    {
        $data =  DB::table('approvel_reviu_kegiatan_anggaran as auk')
                ->where('auk.reviu_kegiatan_anggaran', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->reviu_kegiatan_anggaran == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_kegiatan_anggaran')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->reviu_kegiatan_anggaran == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_kegiatan_anggaran')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_kegiatan_anggaran')->where('reviu_kegiatan_anggaran', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_kegiatan_anggaran')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu Kegiatan Anggaran Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete2($id)
    {
        $gambar = DB::table('kertas_reviu_anggarans')->where('id',$id)->first();
	    File::delete('storage/upload/reviu/anggaran/'.$gambar->filename);
        DB::table('kertas_reviu_anggarans')->where('id', $id)->delete();
        return redirect(route('reviu'))->with(['success' => 'Kertas Kerja Reviu Anggaran Kegiatan Berhasil di Hapus']);      
    }

    ## Reviu LAKIP ##
    public function post3(Request $request)
    {
        $checkdata = DB::table('reviu_lakip')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

               foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/lakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuLakip::create([
                        'kode_reviu_lakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_lakip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('reviu_lakip')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_reviu_lakip')->insert([
                    'reviu_lakip' => $data->id,
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

                DB::table('reviu')->insert([
                    'created_by' => Auth::user()->id,
                    'reviu' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
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
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/lakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuLakip::create([
                        'kode_reviu_lakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_lakip')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
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
                $datacheck = DB::table('reviu_lakip')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/lakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuLakip::create([
                        'kode_reviu_lakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_lakip')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_publish' => 1,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('reviu')->where('reviu', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                $datacheck = DB::table('reviu_lakip')
                    ->where('id', $request->id)
                    ->first();
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/lakip';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuLakip::create([
                        'kode_reviu_lakip' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_lakip')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
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
                
        return redirect(route('reviu').'#reviu_lakip')->with(['success' => 'Pesan Berhasil']);
    }

    public function approvelakip(Request $request)
    {
        $data =  DB::table('approvel_reviu_lakip as auk')
                ->where('auk.reviu_lakip', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            
            if($data->reviu_lakip == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_lakip')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->reviu_lakip == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_lakip')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_lakip')->where('reviu_lakip', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_lakip')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu LAKIP Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete3($id)
    {
        $gambar = DB::table('kertas_reviu_lakips')->where('id',$id)->first();
	    File::delete('storage/upload/reviu/lakip/'.$gambar->filename);
        DB::table('kertas_reviu_lakips')->where('id', $id)->delete();
        return redirect(route('reviu'))->with(['success' => 'Kertas Kerja Reviu LAKIP Berhasil di Hapus']);      
    }


    ## Reviu RKBMN ##
    public function post4(Request $request)
    {
        $checkdata = DB::table('reviu_rkbmn')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'ketua' => 'required',
                'nomor_st' => 'required',
                'tanggal_audit_from' => 'required',
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/rkbmn';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuRkbmn::create([
                        'kode_reviu_rkbmn' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_rkbmn')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('reviu_rkbmn')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_reviu_rkbmn')->insert([
                    'reviu_rkbmn' => $data->id,
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

                DB::table('reviu')->insert([
                    'created_by' => Auth::user()->id,
                    'reviu' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
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
                'tanggal_audit_from' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                'kertas_kerja.*' => 'max:2000000',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/rkbmn';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuRkbmn::create([
                        'kode_reviu_rkbmn' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_rkbmn')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_reviu_from' => $request->tanggal_audit_from,
                    'tanggal_reviu_to' => $request->tanggal_audit_to,
                    'temuan_penjelasan_reviu' => $request->temuan_akibat,
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
                $datacheck = DB::table('reviu_rkbmn')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/rkbmn';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuRkbmn::create([
                        'kode_reviu_rkbmn' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_rkbmn')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_publish' => 1,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
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

                DB::table('reviu')->where('reviu', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {;
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/reviu/rkbmn';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasReviuRkbmn::create([
                        'kode_reviu_rkbmn' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('reviu_rkbmn')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_reviu_from' => $request->tanggal_audit_from,
                'tanggal_reviu_to' => $request->tanggal_audit_to,
                'temuan_penjelasan_reviu' => $request->temuan_sebab,
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
                
        return redirect(route('reviu').'#reviu_rkbmn')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve4(Request $request)
    {
        $data =  DB::table('approvel_reviu_rkbmn as auk')
                ->where('auk.reviu_rkbmn', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->reviu_rkbm == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_rkbmn')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                    return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->reviu_rkbm == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_lakip')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                    return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_reviu_rkbmn')->where('reviu_rkbmn', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu')->where('reviu', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('reviu_rkbmn')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('reviu'))->with(['success' => 'Reviu RKBMN Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete4($id)
    {
        $gambar = DB::table('kertas_reviu_rkbmns')->where('id',$id)->first();
	    File::delete('storage/upload/reviu/rkbmn/'.$gambar->filename);
        DB::table('kertas_reviu_rkbmns')->where('id', $id)->delete();
        return redirect(route('reviu'))->with(['success' => 'Kertas Kerja Reviu RKBMN Berhasil di Hapus']);      
    }
}
