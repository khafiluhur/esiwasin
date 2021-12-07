<?php

namespace App\Http\Controllers\Dashboard;

use DB; 
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanController extends Controller
{

    public function index()
    {

        $anggota = DB::table('users')
                ->get();
        
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $audit = DB::table('audit as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.audit', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.audit')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();

        $reviu = DB::table('reviu as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_reviu_from', 'ak.tanggal_reviu_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.reviu', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.reviu')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        // dd($reviu);

        $evaluasi = DB::table('evaluasi as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_evaluasi_from', 'ak.tanggal_evaluasi_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.evaluasi', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.evaluasi')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();

        $pemantauan = DB::table('pemantauan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pemantauan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();

        $pengawasan = DB::table('pengawasan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pengawasan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();

        $notullen = DB::table('notullensi as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.kode')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        $page = "laporan"; 
        return view('dashboard.laporan',compact('page', 'audit', 'reviu', 'evaluasi', 'pengawasan', 'anggota', 'notullen', 'pemantauan', 'permission'));
    }

    public function laporanAudit() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $audit = DB::table('audit as ak')
                ->select('uc.nama as created_by', 'ak.ketua as kode_ketua', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.audit', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.audit')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.audit',compact('page', 'audit', 'anggota', 'permission'));
    }

    public function cariLaporanAudit(Request $request)
    {
        $periode_from_audit = $request->periode_from_audit;
        $periode_to_audit = $request->periode_to_audit;
        $ketua_audit = $request->ketua_audit;

        $anggota = DB::table('users')->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $audit = DB::table('audit as ak')
                ->select('uc.nama as created_by', 'ak.ketua as kode_ketua', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.audit', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.audit')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->whereBetween('ak.tanggal_audit_from', [$periode_from_audit, $periode_to_audit])
                ->where('ak.ketua','like',"%".$ketua_audit."%")
                ->get();
                
        $page = "laporan"; 
        return view('partial.laporan.audit',compact('page', 'audit', 'anggota', 'permission'));
    }

    public function laporanReviu() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('reviu as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_reviu_from', 'ak.tanggal_reviu_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.reviu', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.reviu')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    public function cariLaporanReviu(Request $request)
    {
        $periode_from_audit = $request->periode_from_audit;
        $periode_to_audit = $request->periode_to_audit;
        $ketua_audit = $request->ketua_audit;

        $anggota = DB::table('users')->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('reviu as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_reviu_from', 'ak.tanggal_reviu_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.reviu', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.reviu')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->whereBetween('ak.tanggal_audit_from', [$periode_from_audit, $periode_to_audit])
                ->where('ak.ketua','like',"%".$ketua_audit."%")
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    public function laporanEvaluasi() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $data = DB::table('evaluasi as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_evaluasi_from', 'ak.tanggal_evaluasi_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.evaluasi', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.evaluasi')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.evaluasi',compact('page', 'data', 'anggota', 'permission'));
    }

    public function cariLaporanEvaluasi(Request $request)
    {
        $periode_from_audit = $request->periode_from_audit;
        $periode_to_audit = $request->periode_to_audit;
        $ketua_audit = $request->ketua_audit;

        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('evaluasi as ak')
                ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_evaluasi_from', 'ak.tanggal_evaluasi_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.evaluasi', 'ak.jenis', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->join('users as at', 'at.id', '=', 'ak.ketua')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.evaluasi')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->whereBetween('ak.tanggal_audit_from', [$periode_from_audit, $periode_to_audit])
                ->where('ak.ketua','like',"%".$ketua_audit."%")
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    public function laporanPemantauan() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $data = DB::table('pemantauan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pemantauan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.pemantauan',compact('page', 'data', 'anggota', 'permission'));
    }

    public function cariLaporanPemantauan(Request $request)
    {
        $periode_from_audit = $request->periode_from_audit;
        $periode_to_audit = $request->periode_to_audit;
        $ketua_audit = $request->ketua_audit;

        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('pemantauan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pemantauan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->whereBetween('ak.tanggal_audit_from', [$periode_from_audit, $periode_to_audit])
                ->where('ak.ketua','like',"%".$ketua_audit."%")
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    public function laporanPengawasan() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $data = DB::table('pengawasan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pengawasan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.pengawasan',compact('page', 'data', 'anggota', 'permission'));
    }

    public function cariLaporanPengawasan(Request $request)
    {
        $periode_from_audit = $request->periode_from_audit;
        $periode_to_audit = $request->periode_to_audit;
        $ketua_audit = $request->ketua_audit;

        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('pengawasan as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.pengawasan')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->whereBetween('ak.tanggal_audit_from', [$periode_from_audit, $periode_to_audit])
                ->where('ak.ketua','like',"%".$ketua_audit."%")
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    public function laporanNotulensi() 
    {
        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                    
        $data = DB::table('notullensi as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.kode')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.notulensi',compact('page', 'data', 'anggota', 'permission'));
    }

    public function cariLaporanNotulensi(Request $request)
    {

        $anggota = DB::table('users')
        ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data = DB::table('notullensi as ak')
                ->select('ak.*', 'uc.nama as created_by', 'fp.id as id_pkpt', 'ip.kegiatan as nama_pkpt')
                ->join('users as uc', 'uc.id', '=', 'ak.created_by')
                ->leftjoin('foreign_pkpt as fp', 'fp.kode', '=', 'ak.kode')
                ->leftjoin('input_pkpt as ip', 'ip.id', '=', 'fp.pkpt')
                ->get();
        
        $page = "laporan"; 
        return view('partial.laporan.reviu',compact('page', 'data', 'anggota', 'permission'));
    }

    ## Audit ##
    // public function get1(Request $request, $id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();

    //    if($id == "cari") {
    //     if($request->ketua_audit == "0") {
    //         $ketua_audit = null;
    //     } else {
    //         $ketua_audit = $request->ketua_audit;
    //     }
    //     // $hello = $request->periode_from_audit == null  && $request->periode_to_audit == null;
    //     // dd($request->ketua_audit);
    //     // dd($request->periode_from_audit);
    //     // dd($request->periode_to_audit);
    //     // dd($hello);
    //     if($request->ketua_audit ==  null && $request->periode_from_audit == null && $request->periode_to_audit == null) {   
    //         $anggota = DB::table('users')
    //             ->get();

    //         $audit = DB::table('audit as ak')
    //             ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //             ->get();
    //         // dd($audit);
    //         $reviu = DB::table('reviu as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_evaluasi_from', 'ak.tanggal_evaluasi_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.jenis')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $pemantauan = DB::table('pemantauan as ak')
    //         ->select('*')
    //         ->get();

    //         $pengawasan = DB::table('pengawasan as ak')
    //         ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //         ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //         ->join('users as at', 'at.id', '=', 'ak.ketua')
    //         ->get();

    //         $notullen = DB::table('notullensi as ak')
    //             ->select('ak.*', 'uc.nama as created_by')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->get();
            
    //         $pesan = "Data Tidak Di Temukan";

    //     } else {
            
    //         $ketua = $request->ketua_audit;
    //         // $periode_from = date($request->periode_from_audit);
    //         // $periode_to = date($request->periode_to_audit);
    //         $periode_from = Carbon::parse($request->periode_from_audit)
    //                          ->toDateTimeString();
    //         $periode_to = Carbon::parse($request->periode_to_audit)
    //                          ->toDateTimeString();
            
    //         // dd($periode_from);
    //         $audit = DB::table('audit')
    //                      ->whereBetween('tanggal_audit_from', array($periode_from,$periode_to))
    //                      ->get();
    //             // dd($audit);
    //         if($periode_from && $periode_to) {
    //             // dd($periode_from);
    //             // $audit = DB::table('audit as ak')
    //             //         ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //             //         ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             //         ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             //         ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                     // ->where('ak.tanggal_audit_from', 'like', "%".$periode_from."%")
    //                     // ->where('ak.tanggal_audit_to', 'like', $periode_to)
    //                     // ->whereBetween('ak.tanggal_audit_from', [$periode_from, $periode_to])
    //                     // ->get(); 
                
    //             $pesan = 'Berhasil';

    //         }else {
    //         $audit = DB::table('audit as ak')
    //                     ->select('uc.nama as created_by', 'ak.ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //                     ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                     ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                     ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                     ->where('ak.ketua', 'like', "%".$ketua."%")
    //                     ->get();

    //             $pesan = 'Berhasil';
    //         }
    //         $anggota = DB::table('users')
    //                 ->get();       

    //         $reviu = DB::table('reviu as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    //         // dd($reviu);
    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $pemantauan = DB::table('pemantauan as ak')
    //             ->select('*')
    //             ->get();

    //         $pengawasan = DB::table('pengawasan as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
            
    //         $notullen = DB::table('notullensi as ak')
    //             ->select('ak.*', 'uc.nama as created_by')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->get();

    //     }
    //         $page = "laporan"; 
    //         return view('dashboard.laporan',compact('page', 'audit', 'reviu', 'evaluasi', 'pengawasan', 'pemantauan', 'anggota', 'notullen', 'permission'))->with(['success' => $pesan]);
    //    } else {
    //     $checkjenis = DB::table('audit')->where('audit', $id)->first();
    //     $group = DB::table('users as u')
    //                 ->join('audit as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();
        
    //     if($checkjenis->jenis == 1) {
    //             $title = "Audit Keuangan";
    //             $audit = DB::table('audit_keuangan as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_keuangan as aak', 'aak.audit_keuangan', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.kode', $id)
    //                 ->where('ak.is_publish', 1)
    //                 ->orderBy('created_at')
    //                 ->first(); 
                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $title = "Audit Kinerja";
    //             $audit = DB::table('audit_kinerja as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_kinerja as aak', 'aak.audit_kinerja', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.kode', $checkjenis->audit)
    //                 ->where('ak.is_publish', 1)
    //                 ->orderBy('created_at')
    //                 ->first();
    //     } else {
    //             $title = "Audit Tujuan Tertentu";
    //             $audit = DB::table('audit_tujuan_tertentu as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_tujuan_tertentu as aak', 'aak.audit_tujuan_tertentu', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //         }
    //         $page = "laporan";
    //         return view('partial.audit.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    //     }
    // }

    public function downloadGet1($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $checkjenis = DB::table('audit')->where('audit', $id)->first();
        if($checkjenis->jenis == 1) {
            $checkkode = DB::table('audit_keuangan')->select('kode')->where('kode', $checkjenis->audit)->first();
            $data = DB::table('kertas_audit_keuangans as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('audit as a', 'a.audit', '=', 'kak.kode_audit_keuangan')
                    ->where('kode_audit_keuangan', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 2) {
            $checkkode = DB::table('audit_kinerja')->select('kode')->where('kode', $checkjenis->audit)->first();
            $data = DB::table('kertas_audit_kinerjas as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('audit as a', 'a.audit', '=', 'kak.kode_audit_kinerja')
                    ->where('kode_audit_kinerja', $checkkode->kode)
                    ->get();
        } else {
            $checkkode = DB::table('audit_tujuan_tertentu')->select('kode')->where('kode', $checkjenis->audit)->first();
            $data = DB::table('kertas_audit_tujuan_tertntus as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('audit as a', 'a.audit', '=', 'kak.kode_audit_tujuan_tertentu')
                    ->where('kode_audit_tujuan_tertentu', $checkkode->kode)
                    ->get();
        }

        $page = "laporan";
        return view('partial.audit.download', compact('data', 'page', 'permission'));
    }

    // public function cari1(Request $request)
    // {
    //     // dd($request);
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
        
                
    //     $ketua = $request->ketua_audit;
    //     $periode_from = $request->periode_from_audit;
    //     $periode_to = $request->periode_to_audit;

    //     if($periode_from && $periode_to) {
    //         $audit = DB::table('audit as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                 ->where('ak.tanggal_audit_from', 'like', "%".$periode_from."%")
    //                 ->where('ak.tanggal_audit_to', 'like', "%".$periode_to."%")
    //                 ->get(); 

    //         $reviu = DB::table('reviu as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    
    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    
    //         $pengawasan = DB::table('pengawasan as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
            
    //         $pesan = 'Berhasil';

    //     }else {
    //        $audit = DB::table('audit as ak')
    //                 ->select('uc.nama as created_by', 'ak.ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'ak.audit as kode', 'ak.id', 'ak.jenis')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                 ->where('ak.ketua', 'like', "%".$ketua."%")
    //                 ->get();

    //         $reviu = DB::table('reviu as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    
    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();
    
    //         $pengawasan = DB::table('pengawasan as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $pesan = 'Berhasil';
    //     }

    //     $anggota = DB::table('users')
    //             ->get();       

    //     $reviu = DB::table('reviu as ak')
    //             ->select('ak.*', 'uc.nama as created_by', 'at.nama as ketua')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->get();

    //     $evaluasi = DB::table('evaluasi as ak')
    //             ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->get();

    //     $pengawasan = DB::table('pengawasan as ak')
    //             ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->get();
        
    //     // dd($reviu);
        
    //     $page = "laporan"; 
    //     return view('dashboard.laporan',compact('page', 'audit', 'reviu', 'evaluasi', 'pengawasan', 'anggota', 'permission'))->with(['success' => $pesan]);
    // }

    // public function downloadLaporan1($id)
    // {
    //     $checkjenis = DB::table('audit')->where('audit', $id)->first();
    //     $group = DB::table('users as u')
    //                 ->join('audit as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();
        
    //     if($checkjenis->jenis == 1) {
    //             $audit = DB::table('audit_keuangan as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_keuangan as aak', 'aak.audit_keuangan', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor(public_path('template/audit.docx'));
    //             $templateProcessor->setValue('title', "Audit Keuangan");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_audit_from.' s/d '.$audit->tanggal_audit_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Audit");
    //             $templateProcessor->setValue('judul', $audit->temuan_judul);
    //             $templateProcessor->setValue('kondisi', $audit->temuan_kondisi);
    //             $templateProcessor->setValue('kriteria', $audit->temuan_kriteria);
    //             $templateProcessor->setValue('sebab', $audit->temuan_sebab);
    //             $templateProcessor->setValue('akibat', $audit->temuan_akibat);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Audit Keuangan' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');

                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $audit = DB::table('audit_kinerja as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_kinerja as aak', 'aak.audit_kinerja', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor(resource_path('template/audit.docx'));
    //             $templateProcessor->setValue('title', "Audit Kinerja");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_audit_from.' s/d '.$audit->tanggal_audit_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Audit");
    //             $templateProcessor->setValue('judul', $audit->temuan_judul);
    //             $templateProcessor->setValue('kondisi', $audit->temuan_kondisi);
    //             $templateProcessor->setValue('kriteria', $audit->temuan_kriteria);
    //             $templateProcessor->setValue('sebab', $audit->temuan_sebab);
    //             $templateProcessor->setValue('akibat', $audit->temuan_akibat);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Audit Kinerja' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } else {
    //             $audit = DB::table('audit_tujuan_tertentu as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_audit_tujuan_tertentu as aak', 'aak.audit_tujuan_tertentu', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor(resource_path('template/audit.docx'));
    //             $templateProcessor->setValue('title', "Audit Tujuan Tertentu");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_audit_from.' s/d '.$audit->tanggal_audit_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Audit");
    //             $templateProcessor->setValue('judul', $audit->temuan_judul);
    //             $templateProcessor->setValue('kondisi', $audit->temuan_kondisi);
    //             $templateProcessor->setValue('kriteria', $audit->temuan_kriteria);
    //             $templateProcessor->setValue('sebab', $audit->temuan_sebab);
    //             $templateProcessor->setValue('akibat', $audit->temuan_akibat);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Audit Tujuan Tertentu' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     }
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }

    ## Reviu ##
    // public function get2(Request $request, $id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();

    //     dd($request);

    //     if($request->ketua_audit && $request->periode_from_audit && $request->periode_to_audit == null) {   
    //         $anggota = DB::table('users')
    //             ->get();

    //         $audit = DB::table('audit as ak')
    //             ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //             ->get();

    //         $reviu = DB::table('reviu as ak')
    //             ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_reviu_from', 'ak.tanggal_reviu_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.jenis')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->join('users as at', 'at.id', '=', 'ak.ketua')
    //             ->get();

    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_evaluasi_from', 'ak.tanggal_evaluasi_to', 'ak.is_prosess', 'ak.created_at', 'ak.id', 'ak.jenis')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $pengawasan = DB::table('pengawasan as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $notullen = DB::table('notullensi as ak')
    //             ->select('ak.*', 'uc.nama as created_by')
    //             ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //             ->get();
            
    //         $pesan = "Data Tidak Di Temukan";

    //     } elseif($request->ketua_audit || $request->periode_from_audit || $request->periode_to_audit == null) {

    //         $ketua = $request->ketua_audit;
    //         $periode_from = $request->periode_from_audit;
    //         $periode_to = $request->periode_to_audit;

    //         if($periode_from && $periode_to) {
    //             $audit = DB::table('audit as ak')
    //                     ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //                     ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                     ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                     ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                     ->where('ak.tanggal_audit_from', 'like', "%".$periode_from."%")
    //                     ->where('ak.tanggal_audit_to', 'like', "%".$periode_to."%")
    //                     ->get(); 
                
    //             $pesan = 'Berhasil';

    //         }else {
            
    //         $audit = DB::table('audit as ak')
    //                     ->select('uc.nama as created_by', 'ak.ketua', 'ak.tanggal_audit_from', 'ak.tanggal_audit_to', 'ak.is_prosess', 'ak.created_at', 'auk.kode', 'ak.id', 'ak.jenis')
    //                     ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                     ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                     ->leftjoin('audit_keuangan as auk', 'auk.id', '=', 'ak.audit')
    //                     ->where('ak.ketua', 'like', "%".$ketua."%")
    //                     ->get();

    //             $pesan = 'Berhasil';
    //         }

    //         $anggota = DB::table('users')
    //                 ->get(); 

    //         $reviu = DB::table('reviu as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $evaluasi = DB::table('evaluasi as ak')
    //                 ->select('uc.nama as created_by', 'ak.nomor_st', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //         $pengawasan = DB::table('pengawasan as ak')
    //                 ->select('uc.nama as created_by', 'at.nama as ketua', 'ak.is_prosess', 'ak.created_at')
    //                 ->join('users as uc', 'uc.id', '=', 'ak.created_by')
    //                 ->join('users as at', 'at.id', '=', 'ak.ketua')
    //                 ->get();

    //     } else {
    //         $page = "laporan"; 
    //         return view('dashboard.reviu',compact('page', 'audit', 'reviu', 'evaluasi', 'pengawasan', 'anggota', 'notullen', 'permission'))->with(['success' => $pesan]);
    //     }

    //    $checkjenis = DB::table('reviu')->where('reviu', $id)->first();
       
    //    $group = DB::table('users as u')
    //                 ->join('reviu as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();

    //    if($checkjenis->jenis == 1) {
    //            $title = "Reviu Laporan Keuangan";
    //            $audit = DB::table('reviu_laporan_keuangan as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_reviu_laporan_keuangan as aak', 'aak.reviu_laporan_keuangan', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first();      
    //    } elseif($checkjenis->jenis == 3) {
    //         $title = "Reviu LAKIP";
    //         $c = DB::table('reviu_lakip as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_reviu_lakip as aak', 'aak.reviu_lakip', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first(); 
    //         dd($audit);
    //    } elseif($checkjenis->jenis == 4) {  
    //         $title = "Reviu RKBMN";
    //         $audit = DB::table('reviu_rkbmn as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_reviu_rkbmn as aak', 'aak.reviu_rkbmn', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first(); 
    //    } else {
    //            $title = "Reviu Anggaran Kegiatan";
    //            $audit = DB::table('reviu_kegiatan_anggaran as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_reviu_kegiatan_anggaran as aak', 'aak.reviu_kegiatan_anggaran', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first(); 
    //    }
    //     $page = "laporan";
    //     return view('partial.reviu.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    // }

     public function downloadGet2($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $checkjenis = DB::table('reviu')->where('reviu', $id)->first();
        
        if($checkjenis->jenis == 1) {
            $checkkode = DB::table('reviu_laporan_keuangan')->select('kode')->where('kode', $checkjenis->reviu)->first();
            $data = DB::table('kertas_reviu_keuangans as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('reviu as a', 'a.reviu', '=', 'kak.kode_reviu_keuangan')
                    ->where('kode_reviu_keuangan', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 2) {
            $checkkode = DB::table('reviu_kegiatan_anggaran')->select('kode')->where('kode', $checkjenis->reviu)->first();
            $data = DB::table('kertas_reviu_anggarans as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('reviu as a', 'a.reviu', '=', 'kak.kode_reviu_anggaran')
                    ->where('kode_reviu_anggaran', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 3) {
            $checkkode = DB::table('reviu_lakip')->select('kode')->where('kode', $checkjenis->reviu)->first();
            $data = DB::table('kertas_reviu_lakips as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('reviu as a', 'a.reviu', '=', 'kak.kode_reviu_lakip')
                    ->where('kode_reviu_lakip', $checkkode->kode)
                    ->get();
        } else {
            $checkkode = DB::table('reviu_rkbmn')->select('kode')->where('kode', $checkjenis->reviu)->first();
            $data = DB::table('kertas_reviu_rkbmns as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('reviu as a', 'a.reviu', '=', 'kak.kode_reviu_rkbmn')
                    ->where('kode_reviu_rkbmn', $checkkode->kode)
                    ->get();
        }

        $page = "laporan";
        return view('partial.reviu.download', compact('data', 'page', 'permission'));
    }

    // public function downloadLaporan2($id)
    // {
    //     $checkjenis = DB::table('reviu')->where('reviu', $id)->first();
    //     $group = DB::table('users as u')
    //                 ->join('reviu as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();
    //     if($checkjenis->jenis == 1) {
    //             $audit = DB::table('reviu_laporan_keuangan as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_reviu_laporan_keuangan as aak', 'aak.reviu_laporan_keuangan', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
              
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Reviu Laporan Keuangan");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_reviu_from.' s/d '.$audit->tanggal_reviu_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Reviu");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan_reviu);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Reviu Laporan Keuangan' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');

                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $audit = DB::table('reviu_kegiatan_anggaran as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_reviu_kegiatan_anggaran as aak', 'aak.reviu_kegiatan_anggaran', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Reviu Kegiatan Anggran");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_reviu_from.' s/d '.$audit->tanggal_reviu_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Reviu");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan_reviu);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Reviu Kegiatan Anggaran' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } elseif($checkjenis->jenis == 3) {
    //         $audit = DB::table('reviu_lakip as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_reviu_lakip as aak', 'aak.reviu_lakip', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Reviu LAKIP");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_reviu_from.' s/d '.$audit->tanggal_reviu_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Reviu");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan_reviu);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Reviu LAKIP' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } else {
    //             $audit = DB::table('reviu_rkbmn as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_reviu_rkbmn as aak', 'aak.reviu_rkbmn', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Reviu RKBMN");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_reviu_from.' s/d '.$audit->tanggal_reviu_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Reviu");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Reviu RKBMN' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     }
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }

    ## Evaluasi ##
    // public function get3($id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
    //    $checkjenis = DB::table('evaluasi')->where('evaluasi', $id)->first();
       
    //    $group = DB::table('users as u')
    //                 ->join('evaluasi as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();

    //    if($checkjenis->jenis == 1) {
    //            $title = "Evaluasi SAKIP";
    //            $audit = DB::table('evaluasi_sakip as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_evaluasi_sakip as aak', 'aak.evaluasi_sakip', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first();
    //    } elseif($checkjenis->jenis == 3) {
    //         $title = "Maturitas SPIP";
    //            $audit = DB::table('evaluasi_spip as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_evaluasi_spip as aak', 'aak.evaluasi_spip', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first();
    //    } elseif($checkjenis->jenis == 4) {
    //         $title = "Evaluasi IACM";
    //            $audit = DB::table('evaluasi_iacm as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_evaluasi_iacm as aak', 'aak.evaluasi_iacm', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first();
    //    } else {
    //             $title = "Evaluasi Reformasi Birokrasi";
    //            $audit = DB::table('evaluasi_reformasi_birokrasi as ak')
    //             ->select(
    //                 'ak.*', 
    //                 'up.nama as users_pembuat', 
    //                 'sp.nama as status_pembuat', 
    //                 'aak.tanggal_pembuat',
    //                 'aak.jam_pembuat',
    //                 'aak.komentar_pembuat',
    //                 'uk.nama as users_ketua', 
    //                 'sk.nama as status_ketua', 
    //                 'aak.tanggal_ketua',
    //                 'aak.jam_ketua',
    //                 'aak.komentar_ketua',
    //                 'aak.users_pt as id_pt',
    //                 'upt.nama as users_pt', 
    //                 'spt.nama as status_pt', 
    //                 'aak.tanggal_pt',
    //                 'aak.jam_pt',
    //                 'aak.komentar_pt',
    //                 'aak.users_pm as id_pm',
    //                 'upm.nama as users_pm', 
    //                 'spm.nama as status_pm', 
    //                 'aak.tanggal_pm',
    //                 'aak.jam_pm',
    //                 'aak.komentar_pm')
    //             ->join('approvel_evaluasi_reformasi_birokrasi as aak', 'aak.evaluasi_reformasi_birokrasi', '=', 'ak.id')
    //             ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //             ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //             ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //             ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //             ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //             ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //             ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //             ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //             ->where('ak.is_publish', 1)
    //             ->where('ak.kode', $id)
    //             ->orderBy('created_at')
    //             ->first();  
    //    }

    //     $page = "laporan";
    //     return view('partial.evaluasi.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    // }

    public function downloadGet3($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $checkjenis = DB::table('evaluasi')->where('evaluasi', $id)->first();
        
        if($checkjenis->jenis == 1) {
            $checkkode = DB::table('evaluasi_sakip')->select('kode')->where('kode', $checkjenis->evaluasi)->first();
            $data = DB::table('kertas_evaluasi_sakips as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('evaluasi as a', 'a.evaluasi', '=', 'kak.kode_evaluasi_sakip')
                    ->where('kode_evaluasi_sakip', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 2) {
            $checkkode = DB::table('evaluasi_reformasi_birokrasi')->select('kode')->where('kode', $checkjenis->evaluasi)->first();
            $data = DB::table('kertas_evaluasi_reformasis as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('evaluasi as a', 'a.evaluasi', '=', 'kak.kode_evaluasi_reformasi')
                    ->where('kode_evaluasi_reformasi', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 3) {
            $checkkode = DB::table('evaluasi_spip')->select('kode')->where('kode', $checkjenis->evaluasi)->first();
            $data = DB::table('kertas_evaluasi_spips as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('evaluasi as a', 'a.evaluasi', '=', 'kak.kode_evaluasi_spip')
                    ->where('kode_evaluasi_spip', $checkkode->kode)
                    ->get();
        } else {
            $checkkode = DB::table('evaluasi_iacm')->select('kode')->where('kode', $checkjenis->evaluasi)->first();
            $data = DB::table('kertas_evaluasi_iacms as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('evaluasi as a', 'a.evaluasi', '=', 'kak.kode_evaluasi_iacm')
                    ->where('kode_evaluasi_iacm', $checkkode->kode)
                    ->get();
        }
        $page = "laporan";
        return view('partial.evaluasi.download', compact('data', 'page', 'permission'));
    }

    // public function downloadLaporan3($id)
    // {

    //     $checkjenis = DB::table('evaluasi')->where('evaluasi', $id)->first();
    //     $group = DB::table('users as u')
    //                 ->join('evaluasi as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();
    //     if($checkjenis->jenis == 1) {
    //             $audit = DB::table('evaluasi_sakip as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_evaluasi_sakip as aak', 'aak.evaluasi_sakip', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Evaluasi SAKIP");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_evaluasi_from.' s/d '.$audit->tanggal_evaluasi_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Evaluasi");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Evaluasi SAKIP' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');

                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $audit = DB::table('evaluasi_reformasi_birokrasi as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_evaluasi_reformasi_birokrasi as aak', 'aak.evaluasi_reformasi_birokrasi', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Evaluasi Reformasi Birokrasi");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_evaluasi_from.' s/d '.$audit->tanggal_evaluasi_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Evaluasi");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Evalusi Reformasi Birokrasi' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } elseif($checkjenis->jenis == 3) {
    //         $audit = DB::table('evaluasi_spip as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_evaluasi_spip as aak', 'aak.evaluasi_spip', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Maturitas SPIP");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_evaluasi_from.' s/d '.$audit->tanggal_evaluasi_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Evaluasi");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Evaluasi SPIP' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } else {
    //             $audit = DB::table('evaluasi_iacm as ak')
    //                 ->select(
    //                     'ak.*', 
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm')
    //                 ->join('approvel_evaluasi_iacm as aak', 'aak.evaluasi_iacm', '=', 'ak.id')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->where('ak.is_prosess', 1)
    //                 ->where('ak.is_publish', 1)
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('created_at')
    //                 ->first();
    //                 $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/reviu.docx');
    //             $templateProcessor->setValue('title', "Evaluasi IACM");
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('anggota1', $anggota[0]->nama);
    //             $templateProcessor->setValue('anggota2', $anggota[1]->nama);
    //             $templateProcessor->setValue('anggota3', $anggota[2]->nama);
    //             $templateProcessor->setValue('anggota4', $anggota[3]->nama);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal_evaluasi_from.' s/d '.$audit->tanggal_evaluasi_to);
    //             $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Evaluasi");
    //             $templateProcessor->setValue('akibat', $audit->temuan_penjelasan);
    //             //supervisi
    //             $templateProcessor->setValue('status_pembuat', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pembuat', $audit->tanggal_pembuat . ' ' . $audit->jam_pembuat);
    //             $templateProcessor->setValue('komentar_pembuat', $audit->komentar_pembuat);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->komentar_ketua == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', null);
    //                 $templateProcessor->setValue('komentar_ketua', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_ketua . ' ' . $audit->jam_ketua);
    //             $templateProcessor->setValue('komentar_ketua', $audit->komentar_ketua);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->komentar_pt == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', null);
    //                 $templateProcessor->setValue('komentar_pt', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt . ' ' . $audit->jam_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->komentar_pm == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', null);
    //                 $templateProcessor->setValue('komentar_pm', null);
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm . ' ' . $audit->jam_pm);
    //             $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $filename = 'Evaluasi IACM' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     }
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }

    ## Pemantauan ##
    // public function get4($id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
    //    $checkjenis = DB::table('pemantauan')->where('pemantauan', $id)->first();
       
    //    $group = DB::table('users as u')
    //                 ->join('pemantauan as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();

    //    if($checkjenis->jenis == 1) {
    //            $title = "Pemantauan TL BPK";
    //            $audit = DB::table('pemantauan_bpk as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //    } elseif($checkjenis->jenis == 2) {
    //         $title = "Pemantauan TL LHA";
    //            $audit = DB::table('pemantauan_lha as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //    } elseif($checkjenis->jenis == 3) {
    //         $title = "Pemantauan SPIP";
    //            $audit = DB::table('pemantauan_spip as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //    } else {
    //             $title = "Pemantauan LHKASN";
    //             $audit = DB::table('pemantauan_lhkasn as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'g.nama as golongan', 'p.nama as pangkat', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('golongan as g', 'g.id', '=', 'bpk.golongan')
    //                 ->leftjoin('pangkat as p', 'p.id', '=', 'bpk.pangkat')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //    }

    //     $page = "laporan";
    //     return view('partial.pemantauan.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    // }

    public function downloadGet4($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $checkjenis = DB::table('pemantauan')
                    ->where('pemantauan', $id)->first();
        
        if($checkjenis->jenis == 1) {
            $checkkode = DB::table('pemantauan_bpk')->select('kode')->where('kode', $checkjenis->pemantauan)->first();
            $data = DB::table('pemantauan_bpk as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pemantauan as a', 'a.pemantauan', '=', 'kak.kode')
                    ->where('kode', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 2) {
            $checkkode = DB::table('pemantauan_lha')->select('kode')->where('kode', $checkjenis->pemantauan)->first();
            $data = DB::table('pemantauan_lha as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pemantauan as a', 'a.pemantauan', '=', 'kak.kode')
                    ->where('kode', $checkkode->kode)
                    ->get();
        } elseif ($checkjenis->jenis == 3) {
            $checkkode = DB::table('pemantauan_spip')->select('kode')->where('kode', $checkjenis->pemantauan)->first();
            $data = DB::table('pemantauan_spip as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pemantauan as a', 'a.pemantauan', '=', 'kak.kode')
                    ->where('kode', $checkkode->kode)
                    ->get();
        } else {
            $checkkode = DB::table('pemantauan_lhkasn')->select('kode')->where('kode', $checkjenis->pemantauan)->first();
            $data = DB::table('pemantauan_lhkasn as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pemantauan as a', 'a.pemantauan', '=', 'kak.kode')
                    ->where('kode', $checkkode->kode)
                    ->get();
        }
        $page = "laporan";
        return view('partial.pemantauan.download', compact('data', 'page', 'permission'));
    }

    // public function downloadLaporan4($id)
    // {
    //     $checkjenis = DB::table('pemantauan')->where('pemantauan', $id)->first();
    //     $group = DB::table('users as u')
    //                 ->join('pemantauan as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();
    //     if($checkjenis->jenis == 1) {
    //             $audit = DB::table('pemantauan_bpk as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //             $templateProcessor = new TemplateProcessor('template/pemantauansatu.docx');
    //             $templateProcessor->setValue('title', "Pemantauan TL BPK");
    //             $templateProcessor->setValue('pembuat', $audit->createdBy);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal);
    //             $templateProcessor->setValue('tahun', $audit->tahun);
    //             $templateProcessor->setValue('status', $audit->status);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Pemantauan");
    //             $templateProcessor->setValue('keterangan', $audit->keterangan);
                
    //             $filename = 'Pemantauan TL BPK' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $audit = DB::table('pemantauan_lha as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/pemantauansatu.docx');
    //             $templateProcessor->setValue('title', "Pemantauan TL LHA");
    //             $templateProcessor->setValue('pembuat', $audit->createdBy);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal);
    //             $templateProcessor->setValue('tahun', $audit->tahun);
    //             $templateProcessor->setValue('status', $audit->status);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Pemantauan");
    //             $templateProcessor->setValue('keterangan', $audit->keterangan);
                
    //             $filename = 'Pemantauan TL LHA' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } elseif($checkjenis->jenis == 3) {
    //         $audit = DB::table('pemantauan_spip as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/pemantauansatu.docx');
    //             $templateProcessor->setValue('title', "Pemantauan SPIP");
    //             $templateProcessor->setValue('pembuat', $audit->createdBy);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal);
    //             $templateProcessor->setValue('tahun', $audit->tahun);
    //             $templateProcessor->setValue('status', $audit->status);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Pemantauan");
    //             $templateProcessor->setValue('keterangan', $audit->keterangan);
                
    //             $filename = 'Pemantauan SPIP' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } else {
    //             $audit = DB::table('pemantauan_lhkasn as bpk')
    //                 ->select('bpk.*', 'u.nama as createdBy', 's.nama as status', 'pm.jenis')
    //                 ->join('users as u', 'u.id', '=', 'bpk.createdBy')
    //                 ->leftjoin('status as s', 's.id', '=', 'bpk.status')
    //                 ->leftjoin('pemantauan as pm', 'pm.pemantauan', '=', 'bpk.kode')
    //                 ->where('bpk.kode', $id)
    //                 ->orderBy('bpk.created_at')
    //                 ->first();
    //             $users = DB::table('users')->where('id', $audit->created_by)->first();
    //             $anggota = DB::table('users')->where('group', $users->group)->where('level', $users->level)->get();
                
    //             $templateProcessor = new TemplateProcessor('template/pemantauansatu.docx');
    //             $templateProcessor->setValue('title', "Pemantauan LHKASN");
    //             $templateProcessor->setValue('pembuat', $audit->createdBy);
    //             $templateProcessor->setValue('tanggal', $audit->tanggal);
    //             $templateProcessor->setValue('tahun', $audit->tahun);
    //             $templateProcessor->setValue('status', $audit->status);
    //             $templateProcessor->setValue('sub_title', "Laporan Hasil Pemantauan");
    //             $templateProcessor->setValue('keterangan', $audit->keterangan);
                
    //             $filename = 'Pemantauan LHKASN' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     }
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }

    ## Notulensi ##
    // public function get5($id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
    //    $title = "Notulensi";
    //    $audit = DB::table('notullensi')->where('kode', $id)->first();
                    
    //     $anggota = DB::table('peserta_notulens')
    //             ->where('kode_notulen', $audit->kode)
    //             ->get();

    //     $page = "laporan";
    //     return view('partial.dokumentasi.notulensi.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    // }

    // public function downloadGet5($id)
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
    //     $data = DB::table('notullensi')
    //                 ->where('kode', $id)->get();
    //     $page = "laporan";
    //     return view('partial.dokumentasi.notulensi.download', compact('data', 'page', 'permission'));
    // }

    // public function downloadLaporan5($id)
    // {
    //     $audit = DB::table('notullensi as n')
    //             ->select('n.*', 'u.nama as created_by')
    //             ->join('users as u', 'u.id', '=', 'n.created_by')
    //             ->where('kode', $id)
    //             ->first();
    //     $peserta = DB::table('peserta_notulens')
    //                ->where('kode_notulen', $id)
    //                ->get();
       
    //     $templateProcessor = new TemplateProcessor('template/notulen.docx');
    //     $templateProcessor->setValue('title', "Notulensi");
    //     $templateProcessor->setValue('nomor', $audit->nomor);
    //     $templateProcessor->setValue('hari', $audit->hari);
    //     $templateProcessor->setValue('pukul', $audit->pukul);
    //     $templateProcessor->setValue('tanggal', $audit->tanggal);
    //     $templateProcessor->setValue('tempat', $audit->tempat);
    //     $templateProcessor->setValue('pimpinan', $audit->pimpinan);
    //     $templateProcessor->setValue('topik', $audit->catatan);
    //     $templateProcessor->setValue('keputusan', $audit->lampiran);
    //     $templateProcessor->setValue('kesimpulan', $audit->kesimpualan);
    //     $templateProcessor->setValue('pembuat', $audit->created_by);
    //     $templateProcessor->setValue('peserta1', $peserta[0]->users);
    //     $templateProcessor->setValue('peserta2', $peserta[1]->users);
        
    //     $filename = 'Notulensi' . $audit->kode;
    //     $templateProcessor->saveAs($filename . '.docx');
            
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }

    ## Pengawasan ##
    // public function get6($id) 
    // {
    //     $permission = DB::table('users as u')
    //             ->select('u.*', 'p.*')
    //             ->join('permission as p', 'p.nip', '=', 'u.nip')
    //             ->where('u.nip', Auth::user()->nip)
    //             ->first();
    //    $checkjenis = DB::table('pengawasan')->where('pengawasan', $id)->first();
       
    //    $group = DB::table('users as u')
    //                 ->join('pengawasan as a', 'a.created_by', '=', 'u.id')
    //                 ->first();
                    
    //     $anggota = DB::table('users')
    //             ->where('group', $group->group)
    //             ->where('level', $group->level)
    //             ->get();

    //    if($checkjenis->jenis == 1) {
    //            $title = "Konsultasi";
    //            $audit = DB::table('konsultasi as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_konsultasi as aak', 'aak.konsultasi', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //     } elseif($checkjenis->jenis == 2) {
    //         $title = "Asistensi";
    //         $audit = DB::table('pelatihan as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_pelatihan as aak', 'aak.pelatihan', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //     } elseif($checkjenis->jenis == 3) {
    //         $title = "Sosialisasi";
    //         $audit = DB::table('koordinasi as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_koordinasi as aak', 'aak.koordinasi', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //     } elseif($checkjenis->jenis == 4) {
    //         $title = "RBZI";
    //         $audit = DB::table('reformasi_birokrasi as ak')
    //             ->select('ak.*', 'pl.nama as periode', 'jl.nama as laporan', 'pw.jenis')
    //             ->join('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //             ->leftjoin('jenis_laporan as jl', 'jl.id', '=', 'ak.jenis')
    //             ->leftjoin('priode_laporan as pl', 'pl.id', '=', 'ak.periode')
    //             ->where('ak.kode', $id)
    //             ->orderBy('ak.created_at')
    //             ->first();
    //     } else {
    //         $title = "SAKIP";
    //         $audit = DB::table('sakip as ak')
    //             ->select('ak.*', 'pl.nama as periode', 'jl.nama as laporan', 'pw.jenis')
    //             ->join('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //             ->leftjoin('jenis_laporan as jl', 'jl.id', '=', 'ak.jenis')
    //             ->leftjoin('priode_laporan as pl', 'pl.id', '=', 'ak.periode')
    //             ->where('ak.kode', $id)
    //             ->orderBy('ak.created_at')
    //             ->first();
    //     }

    //     $page = "laporan";
    //     return view('partial.pengawasan.detail', compact('page', 'audit', 'title', 'anggota', 'permission'));
    // }

    public function downloadGet6($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $checkjenis = DB::table('pengawasan')
                    ->where('pengawasan', $id)->first();
        if($checkjenis->jenis == 4) {
            $checkkode = DB::table('reformasi_birokrasi')->select('kode')->where('kode', $checkjenis->pengawasan)->first();
            $data = DB::table('kertas_reformasis as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pengawasan as a', 'a.pengawasan', '=', 'kak.kode_reformasi')
                    ->where('kak.kode_reformasi', $checkkode->kode)
                    ->get();
        } elseif($checkjenis->jenis == 5) {
            $checkkode = DB::table('sakip')->select('kode')->where('kode', $checkjenis->pengawasan)->first();
            $data = DB::table('kertas_sakips as kak')
                    ->select('kak.*', 'a.jenis')
                    ->join('pengawasan as a', 'a.pengawasan', '=', 'kak.kode_sakip')
                    ->where('kak.kode_sakip', $checkkode->kode)
                    ->get();
        } else {
            $data = [];
        }
        $page = "laporan";
        return view('partial.pengawasan.download', compact('data', 'page', 'permission'));
    }

    // public function downloadLaporan6($id)
    // {
    //     $checkjenis = DB::table('pengawasan')->where('pengawasan', $id)->first();
        
    //     if($checkjenis->jenis == 1) {
    //             $audit = DB::table('konsultasi as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.komentar_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_konsultasi as aak', 'aak.konsultasi', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //             $templateProcessor = new TemplateProcessor('template/pengawasandua.docx');
    //             $templateProcessor->setValue('title', "Pengawasan Konsultasi");
    //             $templateProcessor->setValue('pegawai', $audit->users_pembuat);
    //             $templateProcessor->setValue('status_pegawai', $audit->status_pembuat);
    //             $templateProcessor->setValue('tanggal_pegawai', $audit->tanggal_pembuat);
    //             $templateProcessor->setValue('komentar_pegawai', $audit->komentar_pembuat);
    //             if($audit->nomor_st == 0) {
    //                 $templateProcessor->setValue('nomor_st', "");
    //             } else {
    //                 $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             }
    //             $templateProcessor->setValue('anggota', $audit->users_anggota);
    //             $templateProcessor->setValue('status_anggota', $audit->status_anggota);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_anggota', "");
    //                 $templateProcessor->setValue('komentar_anggota', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_anggota', $audit->tanggal_anggota);
    //                 $templateProcessor->setValue('komentar_anggota', $audit->komentar_anggota);
    //             }
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', "");
    //                 $templateProcessor->setValue('komentar_ketua', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_ketua', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', "");
    //                 $templateProcessor->setValue('komentar_pt', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', "");
    //                 $templateProcessor->setValue('komentar_pm', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm);
    //                 $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $templateProcessor->setValue('penjelasan', $audit->penjelasan);
                
    //             $filename = 'Pengawasan Konsultasi' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
                    
    //     } elseif($checkjenis->jenis == 2) {
    //             $audit = DB::table('pelatihan as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'aak.komentar_anggota',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_pelatihan as aak', 'aak.pelatihan', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //             $templateProcessor = new TemplateProcessor('template/pengawasandua.docx');
    //             $templateProcessor->setValue('title', "Pengawasan Pelatihan");
    //             $templateProcessor->setValue('pegawai', $audit->users_pembuat);
    //             $templateProcessor->setValue('status_pegawai', $audit->status_pembuat);
    //             $templateProcessor->setValue('komentar_pegawai', $audit->komentar_pembuat);
    //             if($audit->nomor_st == 0) {
    //                 $templateProcessor->setValue('nomor_st', "");
    //             } else {
    //                 $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             }
    //             $templateProcessor->setValue('anggota', $audit->users_anggota);
    //             $templateProcessor->setValue('status_anggota', $audit->status_anggota);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_anggota', "");
    //                 $templateProcessor->setValue('komentar_anggota', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_anggota', $audit->tanggal_anggota);
    //                 $templateProcessor->setValue('komentar_anggota', $audit->komentar_anggota);
    //             }
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', "");
    //                 $templateProcessor->setValue('komentar_ketua', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_ketua', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', "");
    //                 $templateProcessor->setValue('komentar_pt', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', "");
    //                 $templateProcessor->setValue('komentar_pm', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm);
    //                 $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $templateProcessor->setValue('penjelasan', $audit->penjelasan);
                
    //             $filename = 'Pengawasan Pelatihan' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } elseif($checkjenis->jenis == 3) {
    //         $audit = DB::table('koordinasi as ak')
    //                 ->select(
    //                     'ak.*',
    //                     'up.nama as users_pembuat', 
    //                     'sp.nama as status_pembuat', 
    //                     'aak.tanggal_pembuat',
    //                     'aak.jam_pembuat',
    //                     'aak.komentar_pembuat',
    //                     'ua.nama as users_anggota', 
    //                     'sa.nama as status_anggota', 
    //                     'aak.tanggal_anggota',
    //                     'aak.komentar_anggota',
    //                     'uk.nama as users_ketua', 
    //                     'sk.nama as status_ketua', 
    //                     'aak.tanggal_ketua',
    //                     'aak.jam_ketua',
    //                     'aak.komentar_ketua',
    //                     'aak.users_pt as id_pt',
    //                     'upt.nama as users_pt', 
    //                     'spt.nama as status_pt', 
    //                     'aak.tanggal_pt',
    //                     'aak.jam_pt',
    //                     'aak.komentar_pt',
    //                     'aak.users_pm as id_pm',
    //                     'upm.nama as users_pm', 
    //                     'spm.nama as status_pm', 
    //                     'aak.tanggal_pm',
    //                     'aak.jam_pm',
    //                     'aak.komentar_pm',
    //                     'pw.jenis')
    //                 ->join('approvel_koordinasi as aak', 'aak.koordinasi', '=', 'ak.kode')
    //                 ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
    //                 ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
    //                 ->leftjoin('users as ua', 'ua.id', '=', 'aak.users_anggota')
    //                 ->leftjoin('status as sa', 'sa.id', '=', 'aak.status_anggota')
    //                 ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
    //                 ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
    //                 ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
    //                 ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
    //                 ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
    //                 ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
    //                 ->leftjoin('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                 ->where('ak.kode', $id)
    //                 ->orderBy('ak.created_at')
    //                 ->first();
    //             $templateProcessor = new TemplateProcessor('template/pengawasandua.docx');
    //             $templateProcessor->setValue('title', "Pengawasan Sosialisasi");
    //             $templateProcessor->setValue('pegawai', $audit->users_pembuat);
    //             $templateProcessor->setValue('status_pegawai', $audit->status_pembuat);
    //             $templateProcessor->setValue('komentar_pegawai', $audit->komentar_pembuat);
    //             if($audit->nomor_st == 0) {
    //                 $templateProcessor->setValue('nomor_st', "");
    //             } else {
    //                 $templateProcessor->setValue('nomor_st', $audit->nomor_st);
    //             }
    //             $templateProcessor->setValue('anggota', $audit->users_anggota);
    //             $templateProcessor->setValue('status_anggota', $audit->status_anggota);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_anggota', "");
    //                 $templateProcessor->setValue('komentar_anggota', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_anggota', $audit->tanggal_anggota);
    //                 $templateProcessor->setValue('komentar_anggota', $audit->komentar_anggota);
    //             }
    //             $templateProcessor->setValue('ketua', $audit->users_ketua);
    //             $templateProcessor->setValue('status_ketua', $audit->status_ketua);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_ketua', "");
    //                 $templateProcessor->setValue('komentar_ketua', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_ketua', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_ketua', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pt', $audit->users_pt);
    //             $templateProcessor->setValue('status_pt', $audit->status_pt);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pt', "");
    //                 $templateProcessor->setValue('komentar_pt', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pt', $audit->tanggal_pt);
    //                 $templateProcessor->setValue('komentar_pt', $audit->komentar_pt);
    //             }
    //             $templateProcessor->setValue('pm', $audit->users_pm);
    //             $templateProcessor->setValue('status_pm', $audit->status_pm);
    //             if($audit->tanggal_anggota == 0) {
    //                 $templateProcessor->setValue('tanggal_pm', "");
    //                 $templateProcessor->setValue('komentar_pm', "");
    //             } else {
    //                 $templateProcessor->setValue('tanggal_pm', $audit->tanggal_pm);
    //                 $templateProcessor->setValue('komentar_pm', $audit->komentar_pm);
    //             }
    //             $templateProcessor->setValue('penjelasan', $audit->penjelasan);
                
    //             $filename = 'Pengawasan Sosialisasi' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } elseif($checkjenis->jenis == 4) {
    //             $audit = DB::table('reformasi_birokrasi as ak')
    //                     ->select('ak.*', 'pl.nama as periode', 'jl.nama as laporan', 'pw.jenis')
    //                     ->join('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                     ->leftjoin('jenis_laporan as jl', 'jl.id', '=', 'ak.jenis')
    //                     ->leftjoin('priode_laporan as pl', 'pl.id', '=', 'ak.periode')
    //                     ->where('ak.kode', $id)
    //                     ->orderBy('ak.created_at')
    //                     ->first();
    //             $templateProcessor = new TemplateProcessor('template/pengawasansatu.docx');
    //             $templateProcessor->setValue('title', "Pengawasan RBZI");
    //             $templateProcessor->setValue('jenis_laporan', $audit->laporan);
    //             $templateProcessor->setValue('periode_laporan', $audit->periode);
                
    //             $filename = 'Pengawasan RBZI' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     } else {
    //             $audit = DB::table('sakip as ak')
    //                     ->select('ak.*', 'pl.nama as periode', 'jl.nama as laporan', 'pw.jenis')
    //                     ->join('pengawasan as pw', 'pw.pengawasan', '=', 'ak.kode')
    //                     ->leftjoin('jenis_laporan as jl', 'jl.id', '=', 'ak.jenis')
    //                     ->leftjoin('priode_laporan as pl', 'pl.id', '=', 'ak.periode')
    //                     ->where('ak.kode', $id)
    //                     ->orderBy('ak.created_at')
    //                     ->first();
    //             $templateProcessor = new TemplateProcessor('template/pengawasansatu.docx');
    //             $templateProcessor->setValue('title', "Pengawasan SAKIP");
    //             $templateProcessor->setValue('jenis_laporan', $audit->laporan);
    //             $templateProcessor->setValue('periode_laporan', $audit->periode);
                
    //             $filename = 'Pengawasan SAKIP' . $audit->kode;
    //             $templateProcessor->saveAs($filename . '.docx');
    //     }
    //     return response()->download($filename . '.docx')->deleteFileAfterSend(true);
    // }
}
