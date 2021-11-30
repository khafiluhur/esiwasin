<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Auth;
use Carbon\Carbon;
use App\KertasSakip;
use App\KertasReformasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengawasanController extends Controller
{

    public function index()
    {
        $ketua = DB::table('users')
                ->select('users.id', 'users.nama')
                ->where('users.group', '=', Auth::user()->group)
                ->where('users.level', '=', 1)
                ->get(); 

        $anggota = DB::table('users')->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $jenis = DB::table('jenis_laporan')
                 ->get();
                 
        $periode = DB::table('priode_laporan')
                   ->get();      
                   
        $pkpt_konsultasi = DB::table('input_pkpt')->where('jenis', 16)->get();
        $pkpt_sosialisasi = DB::table('input_pkpt')->where('jenis', 17)->get();
        $pkpt_asistensi = DB::table('input_pkpt')->where('jenis', 18)->get();
        $pkpt_rbzi = DB::table('input_pkpt')->where('jenis', 19)->get();
        $pkpt_sakip = DB::table('input_pkpt')->where('jenis', 20)->get();

        $data1 = DB::table('konsultasi as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.id as id_status_pembuat',
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'aak.users_anggota as id_anggota', 
                    'uag.nama as users_anggota', 
                    'sag.nama as status_anggota', 
                    'aak.tanggal_anggota',
                    'aak.jam_anggota',
                    'aak.komentar_anggota',
                    'uk.id as id_users_ketua',
                    'uk.nama as users_ketua', 
                    'sk.id as id_status_ketua',
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.id as id_status_pt',
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
                ->join('approvel_konsultasi as aak', 'aak.konsultasi', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uag', 'uag.id', '=', 'aak.users_anggota')
                ->leftjoin('status as sag', 'sag.id', '=', 'aak.status_anggota')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();
        ## Pengaawasan Pelatiahan ##
        $data2 = DB::table('pelatihan as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.id as id_status_pembuat',
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'aak.users_anggota as id_anggota', 
                    'uag.nama as users_anggota', 
                    'sag.nama as status_anggota', 
                    'aak.tanggal_anggota',
                    'aak.jam_anggota',
                    'aak.komentar_anggota',
                    'uk.id as id_users_ketua',
                    'uk.nama as users_ketua', 
                    'sk.id as id_status_ketua',
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.id as id_status_pt',
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
                ->join('approvel_pelatihan as aak', 'aak.pelatihan', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uag', 'uag.id', '=', 'aak.users_anggota')
                ->leftjoin('status as sag', 'sag.id', '=', 'aak.status_anggota')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();
                
        ## Pengaawasan Koordinasi ##
        $data3 = DB::table('koordinasi as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.id as id_status_pembuat',
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
                    'aak.users_anggota as id_anggota', 
                    'uag.nama as users_anggota', 
                    'sag.nama as status_anggota', 
                    'aak.tanggal_anggota',
                    'aak.jam_anggota',
                    'aak.komentar_anggota',
                    'uk.id as id_users_ketua',
                    'uk.nama as users_ketua', 
                    'sk.id as id_status_ketua',
                    'sk.nama as status_ketua', 
                    'aak.tanggal_ketua',
                    'aak.jam_ketua',
                    'aak.komentar_ketua',
                    'aak.users_pt as id_pt',
                    'upt.nama as users_pt', 
                    'spt.id as id_status_pt',
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
                ->join('approvel_koordinasi as aak', 'aak.koordinasi', '=', 'ak.kode')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uag', 'uag.id', '=', 'aak.users_anggota')
                ->leftjoin('status as sag', 'sag.id', '=', 'aak.status_anggota')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('ak.created_at', 'desc')
                ->first();

        $page = "pengawasan"; 
        return view('dashboard.pengawasan', compact('page', 'pkpt_konsultasi', 'pkpt_sosialisasi', 'pkpt_asistensi', 'pkpt_rbzi', 'pkpt_sakip', 'anggota', 'ketua', 'data1', 'data2', 'data3', 'jenis', 'periode', 'permission'));
    }


    ## Pengawasan Konsultasi ##
    public function post1(Request $request)
    {
        $checkdata = DB::table('konsultasi')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            $this->validate($request, [
            ## Form Request ##
            'pegawai' => 'required',
            'judul' => 'required',
            'penjelasan' => 'required',

            ## Form Comment ##
            'komentar' => 'required'
            ]);

            DB::table('konsultasi')->insert([
                'kode' => $request->kode,
                'pegawai' => Auth::user()->id,
                'judul' => $request->judul,
                'penjelasan' => $request->penjelasan,
                'nomor_st' => 0,
                'is_prosess' => 1,
                'is_status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $data = DB::table('konsultasi')
                    ->select('id')
                    ->where('kode', $request->kode)
                    ->first(); 
                    
            // $anggota = DB::table('users')
            //         ->where('level', 2)
            //         ->where('id', '<>', Auth::user()->id)
            //         ->inRandomOrder()
            //         ->limit(1)
            //         ->first();

            DB::table('approvel_konsultasi')->insert([
                'konsultasi' => $request->kode,
                'users_pembuat' => Auth::user()->id,
                'status_pembuat' => 1,
                'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                'jam_pembuat' => Carbon::now()->format('H:m'),
                'komentar_pembuat' => $request->komentar,
                'users_anggota' => $request->pegawai,
                'status_anggota' => 0,
                'tanggal_anggota' => 0,
                'jam_anggota' => 0,
                'komentar_anggota' => 0,
                'users_ketua' => 0,
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

            DB::table('pengawasan')->insert([
                'pengawasan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pengawasan_from' => 0,
                'tanggal_pengawasan_to' => 0,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 1
            ]);

        } else {
            $datacheck = DB::table('konsultasi')
                ->where('id', $request->id)
                ->first();

            $this->validate($request, 
            [
                'komentar' => 'required',
            ]);

           DB::table('konsultasi')->where('id', $request->id)->update([
            'pengawai' => $request->pegawai,
            'judul' => $request->judul,
            'penjelasan' => $request->penjelasan,
            'nomor_st' => 0,
            'is_prosess' => 1,
            'is_status' => 1,
            'updated_at' => Carbon::now()
            ]); 

            DB::table('approvel_konsultasi')->where('konsultasi', $request->id)->update([
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

            DB::table('konsultasi')->where('id', $request->id)->update([
                'is_prosess' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        };          
                
        return redirect(route('pengawasan').'#konsultasi')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve1(Request $request)
    {
        // dd($request);
        $data =  DB::table('approvel_konsultasi as auk')
                ->where('auk.konsultasi', $request->kode)
                ->first();
        
        $this->validate($request, 
        [
            'ketua' => 'required',
            'nomor_st' => 'required',
            'komentar' => 'required'
        ]);

        if($request->has('kirim')) {
            if($data->konsultasi == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_anggota' => 2,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->konsultasi == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_pembuat' => 4,
                    'status_anggota' => 3,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultan Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_konsultasi')->where('konsultasi', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    ## Pengawasan Pelatihan ##
    public function post2(Request $request)
    {
        $checkdata = DB::table('pelatihan')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            $this->validate($request, [
            ## Form Request ##
            'pegawai' => 'required',
            'judul' => 'required',
            'penjelasan' => 'required',

            ## Form Comment ##
            'komentar' => 'required'
            ]);

            DB::table('pelatihan')->insert([
                'kode' => $request->kode,
                'pegawai' => Auth::user()->id,
                'judul' => $request->judul,
                'penjelasan' => $request->penjelasan,
                'nomor_st' => 0,
                'is_prosess' => 1,
                'is_status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $data = DB::table('pelatihan')
                    ->select('kode')
                    ->where('kode', $request->kode)
                    ->first();  

            DB::table('approvel_pelatihan')->insert([
                'pelatihan' => $request->kode,
                'users_pembuat' => Auth::user()->id,
                'status_pembuat' => 1,
                'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                'jam_pembuat' => Carbon::now()->format('H:m'),
                'komentar_pembuat' => $request->komentar,
                'users_anggota' => $request->pegawai,
                'status_anggota' => 0,
                'tanggal_anggota' => 0,
                'jam_anggota' => 0,
                'komentar_anggota' => 0,
                'users_ketua' => 0,
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

            DB::table('pengawasan')->insert([
                'pengawasan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pengawasan_from' => 0,
                'tanggal_pengawasan_to' => 0,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 2
            ]);

        } else {

            $this->validate($request, 
            [
                'komentar' => 'required',
            ]);

           DB::table('pelatihan')->where('kode', $request->kode)->update([
            'pengawai' => $request->pegawai,
            'judul' => $request->judul,
            'penjelasan' => $request->penjelasan,
            'nomor_st' => 0,
            'is_prosess' => 1,
            'is_status' => 1,
            'updated_at' => Carbon::now()
            ]); 

            DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                'status_pembuat' => 1,
                'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                'jam_pembuat' => Carbon::now()->format('H:m'),
                'komentar_pembuat' => $request->komentar,
                'updated_at' => Carbon::now()
            ]);

            DB::table('pelatihan')->where('kode', $request->kode)->update([
                'is_prosess' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        };          
                
        return redirect(route('pengawasan').'#pelatihan')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve2(Request $request)
    {
        $data =  DB::table('approvel_pelatihan as auk')
                ->where('auk.pelatihan', $request->kode)
                ->first();

        // $this->validate($request, 
        // [
        //     'ketua' => 'required',
        //     'nomor_st' => 'requred',
        //     'komentar' => 'required',
        // ]);

        if($request->has('kirim')) {
            if($data->pelatihan == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_anggota' => 2,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('pelatihan')->where('kode', $request->kode)->update([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('pelatihan')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->pelatihan == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_pembuat' => 4,
                    'status_anggota' => 3,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('pelatihan')->where('kode', $request->kode)->updated([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('pelatihan')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_pelatihan')->where('pelatihan', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('konsultasi')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Asistensi Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    ## Pengawasan Koordinasi ##
    public function post3(Request $request)
    {
        $checkdata = DB::table('koordinasi')
                    ->where('kode', $request->kode)
                    ->first();
        
        if($checkdata == null) {
            $this->validate($request, [
            ## Form Request ##
            'pegawai' => 'required',
            'judul' => 'required',
            'penjelasan' => 'required',

            ## Form Comment ##
            'komentar' => 'required'
            ]);

            DB::table('koordinasi')->insert([
                'kode' => $request->kode,
                'pegawai' => Auth::user()->id,
                'judul' => $request->judul,
                'penjelasan' => $request->penjelasan,
                'nomor_st' => 0,
                'is_prosess' => 1,
                'is_status' => 1,
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

            $data = DB::table('koordinasi')
                    ->select('kode')
                    ->where('kode', $request->kode)
                    ->first(); 

            DB::table('approvel_koordinasi')->insert([
                'koordinasi' => $request->kode,
                'users_pembuat' => Auth::user()->id,
                'status_pembuat' => 1,
                'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                'jam_pembuat' => Carbon::now()->format('H:m'),
                'komentar_pembuat' => $request->komentar,
                'users_anggota' => $request->pegawai,
                'status_anggota' => 0,
                'tanggal_anggota' => 0,
                'jam_anggota' => 0,
                'komentar_anggota' => 0,
                'users_ketua' => 0,
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

            DB::table('pengawasan')->insert([
                'pengawasan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pengawasan_from' => 0,
                'tanggal_pengawasan_to' => 0,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 3
            ]);

        } else {

            $this->validate($request, 
            [
                'komentar' => 'required',
            ]);

           DB::table('koordinasi')->where('kode', $request->kode)->update([
            'pengawai' => $request->ketua,
            'judul' => $request->nomor_st,
            'penjelasan' => $request->temuan_sebab,
            'nomot_st' => 0,
            'is_prosess' => 1,
            'is_status' => 1,
            'updated_at' => Carbon::now()
            ]); 

            DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
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

            DB::table('koordinasi')->where('kode', $request->kode)->update([
                'is_prosess' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
        };          
                
        return redirect(route('pengawasan').'#koordinasi')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve3(Request $request)
    {
        $data =  DB::table('approvel_koordinasi as auk')
                ->where('auk.koordinasi', $request->kode)
                ->first();

        // $this->validate($request, 
        // [
        //     'ketua' => 'required',
        //     'nomor_st' => 'requred',
        //     'komentar' => 'required',
        // ]);

        if($request->has('kirim')) {
            if($data->koordinasi == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_anggota' => 2,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('koordinasi')->where('kode', $request->kode)->update([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                    
                     return redirect(route('pengawasan'))->with(['success' => 'Sosialisasi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Sosialisasi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Sosialisasi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('koordinasi')->where('kode', $request->kode)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Sosialisasi Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->koordinasi == $request->kode) {
                if($data->users_anggota == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'users_ketua' => $request->ketua,
                    'status_pembuat' => 4,
                    'status_anggota' => 3,
                    'tanggal_anggota' => Carbon::now()->format('d/m/yy'),
                    'jam_anggota' => Carbon::now()->format('H:m'),
                    'komentar_anggota' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('pelatihan')->where('kode', $request->kode)->update([
                        'nomor_st' => $request->nomor_st,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Konsultasi Berhasil di Setujui']);
                }elseif($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('koordinasi')->where('kode', $request->kode)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Koordinasi Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Koordinasi Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_koordinasi')->where('koordinasi', $request->kode)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('koordinasi')->where('kode', $request->kode)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('pengawasan'))->with(['success' => 'Koordinasi Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    ## Pengawasan Reformasi Birokrasi & Zona Integritas ##
    public function post4(Request $request)
    {

        $this->validate($request, [
        ## Form Request ##
        'jenis' => 'required',
        'periode' => 'required',

        ## Form Laporan ##
        'laporan' => 'required',
        'laporan.*' => 'mimes:doc,pdf,docx,zip'
        ]);

        foreach ($request->laporan as $photo) {
            $extension = $photo->getClientOriginalExtension();
            $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
            $folder = 'storage/upload/pengawasan/reformasi';
            $photopath = $folder.$photoname;
            $photo->move(public_path($folder),$photoname);
            $data[] = $photoname;
            KertasReformasi::create([
                'kode_reformasi' => $request->kode,
                'filename' => $photoname
            ]);
        }

        DB::table('reformasi_birokrasi')->insert([
            'jenis' => $request->jenis,
            'kode' => $request->kode,
            'periode' => $request->periode,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); 

        DB::table('foreign_pkpt')->insert([
            'kode' => $request->kode,
            'pkpt' => $request->pkpt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('pengawasan')->insert([
            'pengawasan' => $request->kode,
            'created_by' => Auth::user()->id,
            'tanggal_pengawasan_from' => $request->periode,
            'tanggal_pengawasan_to' => $request->periode,
            'ketua' => 0,
            'is_prosess' => 1,
            'jenis' => 4
        ]);
                
        return redirect(route('pengawasan').'#koordinasi')->with(['success' => 'Pesan Berhasil']);
    }

    ## Pengawasan SAKIP ##
    public function post5(Request $request)
    {
        $this->validate($request, [
        ## Form Request ##
        'jenis' => 'required',
        'periode' => 'required',
        'laporan' => 'required',
        ]);

        foreach ($request->laporan as $photo) {
            $extension = $photo->getClientOriginalExtension();
            $name = explode(".",$photo->getClientOriginalName());
            $photoname = $name[0].rand(10000,99999).'.'.$extension;
            $folder = 'storage/upload/pengawasan/sakip';
            $photopath = $folder.$photoname;
            $photo->move(public_path($folder),$photoname);
            $data[] = $photoname;
            KertasSakip::create([
                'kode_sakip' => $request->kode,
                'filename' => $photoname
            ]);
        }

        DB::table('sakip')->insert([
            'jenis' => $request->jenis,
            'kode' => $request->kode,
            'periode' => $request->periode,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('foreign_pkpt')->insert([
            'kode' => $request->kode,
            'pkpt' => $request->pkpt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('pengawasan')->insert([
            'pengawasan' => $request->kode,
            'created_by' => Auth::user()->id,
            'tanggal_pengawasan_from' => $request->periode,
            'tanggal_pengawasan_to' => $request->periode,
            'ketua' => 0,
            'is_prosess' => 1,
            'jenis' => 5
        ]);
                
        return redirect(route('pengawasan').'#koordinasi')->with(['success' => 'Pesan Berhasil']);
    }
}
