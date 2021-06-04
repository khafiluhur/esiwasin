<?php

namespace App\Http\Controllers\Dashboard;

use DB; 
use Auth;
use File;
use Carbon\Carbon;
use App\KertasAuditKinerja;
use Illuminate\Http\Request;
use App\KertasAuditKeuangan;
use App\KertasAuditTujuanTertntu;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        // $ketua = DB::table('users')
        //         ->select('users.id', 'users.nama')
        //         ->where('users.group', '=', Auth::user()->group)
        //         ->where('users.level', '=', 1)
        //         ->get(); 

        $anggota = DB::table('users')
                ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
                
        $pkpt_keuangan = DB::table('input_pkpt')->where('jenis', 1)->get();
        $pkpt_kinerja = DB::table('input_pkpt')->where('jenis', 2)->get();
        $pkpt_tujuan = DB::table('input_pkpt')->where('jenis', 3)->get();

        $total_ketua = DB::table('audit_keuangan as ak')
                ->select(DB::raw('COUNT(ak.ketua) as total'))
                ->groupBy('ak.ketua')
                ->where('ak.ketua','=', Auth::user()->id)
                ->get();
        $total_anggota = DB::table('audit_keuangan as ak')
                ->select(DB::raw('COUNT(ak.created_by) as total'))
                ->groupBy('ak.created_by')
                ->where('ak.created_by','=', Auth::user()->id)
                ->get();
        // dd($total_ketua);
    
        ## Audit Keuangan ##
        $data1 = DB::table('audit_keuangan as ak')
                ->select(
                    'ak.*', 
                    'up.nama as users_pembuat', 
                    'sp.id as id_status_pembuat',
                    'sp.nama as status_pembuat', 
                    'aak.tanggal_pembuat',
                    'aak.jam_pembuat',
                    'aak.komentar_pembuat',
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
                ->join('approvel_audit_keuangan as aak', 'aak.audit_keuangan', '=', 'ak.id')
                ->join('users as up', 'up.id', '=', 'aak.users_pembuat')
                ->join('status as sp', 'sp.id', '=', 'aak.status_pembuat')
                ->leftjoin('users as uk', 'uk.id', '=', 'aak.users_ketua')
                ->leftjoin('status as sk', 'sk.id', '=', 'aak.status_ketua')
                ->leftjoin('users as upt', 'upt.id', '=', 'aak.users_pt')
                ->leftjoin('status as spt', 'spt.id', '=', 'aak.status_pt')
                ->leftjoin('users as upm', 'upm.id', '=', 'aak.users_pm')
                ->leftjoin('status as spm', 'spm.id', '=', 'aak.status_pm')
                ->where('ak.is_prosess', 1)
                ->orderBy('created_at', 'desc')
                ->first();
        if($data1) {
            $file1 = DB::table('kertas_audit_keuangans')
                ->where('kode_audit_keuangan', $data1->kode)
                ->get();
            $group_pembuat = DB::table('users')
                           ->where('id', $data1->created_by)
                           ->first();

            $anggota_pembuat1 = DB::table('users')
                           ->where('group', '=', $group_pembuat->group)
                           ->get();
        }else {
            $file1 = null;
            $group_pembuat = null;
            $anggota_pembuat1 = null;
        }
        
        ## Audit Kinerja ##
        $data2 = DB::table('audit_kinerja as ak')
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
                ->join('approvel_audit_kinerja as aak', 'aak.audit_kinerja', '=', 'ak.id')
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
        if($data2) {
            $file2 = DB::table('kertas_audit_kinerjas')
                ->where('kode_audit_kinerja', $data2->kode)
                ->get(); 
            $group_pembuat = DB::table('users')
                           ->where('id', $data2->created_by)
                           ->first();

            $anggota_pembuat2 = DB::table('users')
                           ->where('group', '=', $group_pembuat->group)
                           ->get();
        }else {
            $file2 = null;
            $group_pembuat = null;
            $anggota_pembuat2 = null;
        }    
        
        
        ## Audit Tujuan Tertentu ##
        $data3 = DB::table('audit_tujuan_tertentu as ak')
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
                ->join('approvel_audit_tujuan_tertentu as aak', 'aak.audit_tujuan_tertentu', '=', 'ak.id')
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
            $file3 = DB::table('kertas_audit_tujuan_tertntus')
                ->where('kode_audit_tujuan_tertentu', $data3->kode)
                ->get(); 
            $group_pembuat = DB::table('users')
                             ->where('id', $data3->created_by)
                             ->first();

            $anggota_pembuat3 = DB::table('users')
                           ->where('group', '=', $group_pembuat->group)
                           ->get();
        }else {
            $file3 = null;
            $group_pembuat = null;
            $anggota_pembuat3 = null;
        }        
    
                $page = "audit"; 
        return view('dashboard.audit', compact('page', 'pkpt_keuangan', 'pkpt_kinerja', 'pkpt_tujuan', 'anggota', 'anggota_pembuat1', 'anggota_pembuat2', 'anggota_pembuat3', 'data1', 'file1', 'data2', 'file2', 'data3', 'file3', 'permission'));
    }

    ## Audit Keuangan ##
    public function post1(Request $request)
    {
        $checkdata = DB::table('audit_keuangan')
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                'kertas_kerja.*' => 'max:2000000',

                ## Form Comment ##
                'komentar' => 'required'
                ],
                [
                    'ketua.required' => 'Belum memlih Ketua Tim',
                    'nomor_st' => 'Belum menginputkan Nomor Surat Tugas',
                    'tanggal_audit_from' => 'Belum menginputkan Tanggal Audit Dari',
                    'tanggal_audit_to' => 'Belum menginputkan Tanggal Audit Sampai',
                    'temuan Judul' => 'Belum menginputkan Judul Temuan',
                    'temuan Kondisi' => 'Belum menginputkan Kondisi Temuan',
                    'temuan Kriteria' => 'Belum menginputkan Kriteria Temuan',
                    'temuan Sebab' => 'Belum menginputkan Sebab Temuan',
                    'temuan Akibat' => 'Belum menginputkan Akibat Temuan',
                    'temuan kerja_kerja' => 'Belum mengupload Kertas Kerja',
                    'komentar' => 'Belum menginputkan Komentar',
                    'kertas_kerja' => 'Belum mengupload kertas kerja',
                    'kertas_kerja:mimes' => 'Kertas kerja tidak sesuai dengan format, format wajib : DOC, PDF, DOCX, ZIP',
                    'kertas_kerja:max' => 'Ukuran Kerta Kerja terlalu besar, maks: 20MB',
                ]
            );

            foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    // dd($photoname);
                    $folder = 'storage/upload/audit/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKeuangan::create([
                        'audit_keuangan' => 0,
                        'kode_audit_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_keuangan')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0, 
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('audit_keuangan')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first(); 
                        
                DB::table('kertas_audit_keuangans')->where('kode_audit_keuangan', $request->kode)->update([
                    'audit_keuangan' => $data->id
                ]);
                        

                DB::table('approvel_audit_keuangan')->insert([
                    'audit_keuangan' => $data->id,
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

                DB::table('audit')->insert([
                    'created_by' => Auth::user()->id,
                    'audit' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                'kertas_kerja.*' => 'max:2000000'
                ],
                [
                    'ketua.required' => 'Belum memlih Ketua Tim',
                    'nomor_st' => 'Belum menginputkan Nomor Surat Tugas',
                    'tanggal_audit_from' => 'Belum menginputkan Tanggal Audit Dari',
                    'tanggal_audit_to' => 'Belum menginputkan Tanggal Audit Sampai',
                    'temuan Judul' => 'Belum menginputkan Judul Temuan',
                    'temuan Kondisi' => 'Belum menginputkan Kondisi Temuan',
                    'temuan Kriteria' => 'Belum menginputkan Kriteria Temuan',
                    'temuan Sebab' => 'Belum menginputkan Sebab Temuan',
                    'temuan Akibat' => 'Belum menginputkan Akibat Temuan',
                    'temuan kerja_kerja' => 'Belum mengupload Kertas Kerja',
                    'komentar' => 'Belum menginputkan Komentar',
                    'kertas_kerja' => 'Belum mengupload kertas kerja',
                    'kertas_kerja:mimes' => 'Kertas kerja tidak sesuai dengan format, format wajib : DOC, PDF, DOCX, ZIP',
                    'kertas_kerja:max' => 'Ukuran Kerta Kerja terlalu besar, maks: 20MB',
                ]
                );

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKeuangan::create([
                        'audit_keuangan' => $request->id,
                        'kode_audit_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::table('audit_keuangan')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 0,
                    'is_save' => 1, 
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }        
        } else {
            if($request->has('kirim')) {
                $datacheck = DB::table('audit_keuangan')
                ->where('id', $request->id)
                ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKeuangan::create([
                        'audit_keuangan' => $request->id,
                        'kode_audit_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_keuangan')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_audit_from' => $request->tanggal_audit_from,
                'tanggal_audit_to' => $request->tanggal_audit_to,
                'temuan_judul' => $request->temuan_judul,
                'temuan_kondisi' => $request->temuan_kondisi,
                'temuan_kriteria' => $request->temuan_kriteria,
                'temuan_sebab' => $request->temuan_sebab,
                'temuan_akibat' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_save' => 1, 
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_pembuat' => 1,
                    'tanggal_pembuat' => Carbon::now()->format('d/m/yy'),
                    'jam_pembuat' => Carbon::now()->format('H:m'),
                    'komentar_pembuat' => $request->komentar,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('audit')->where('audit', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/keuangan';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKeuangan::create([
                        'kode_audit_keuangan' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_keuangan')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_audit_from' => $request->tanggal_audit_from,
                'tanggal_audit_to' => $request->tanggal_audit_to,
                'temuan_judul' => $request->temuan_judul,
                'temuan_kondisi' => $request->temuan_kondisi,
                'temuan_kriteria' => $request->temuan_kriteria,
                'temuan_sebab' => $request->temuan_sebab,
                'temuan_akibat' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_save' => 1, 
                'updated_at' => Carbon::now()
                ]); 
            }
        };          
                
        return redirect(route('audit').'#audit_keuangan')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve1(Request $request)
    {
        $data =  DB::table('approvel_audit_keuangan as auk')
                ->where('auk.audit_keuangan', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->audit_keuangan == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_keuangan')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->audit_keuangan == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_keuangan')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_keuangan')->where('audit_keuangan', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_keuangan')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }else {

                } 
            }
        
        }
    }

    public function delete1($id)
    {
        $gambar = DB::table('kertas_audit_keuangans')->where('id',$id)->first();
	    File::delete('storage/upload/audit/keuangan/'.$gambar->filename);
        DB::table('kertas_audit_keuangans')->where('id', $id)->delete();
        return redirect(route('audit'))->with(['success' => 'Kertas Kerja Audit Keuangan Berhasil di Hapus']);      
    }


    ## Audit Kinerja ##
    public function post2(Request $request)
    {
        $checkdata = DB::table('audit_kinerja')
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ],
                [
                    'ketua.required' => 'Belum memlih Ketua Tim',
                    'nomor_st' => 'Belum menginputkan Nomor Surat Tugas',
                    'tanggal_audit_from' => 'Belum menginputkan Tanggal Audit Dari',
                    'tanggal_audit_to' => 'Belum menginputkan Tanggal Audit Sampai',
                    'temuan Judul' => 'Belum menginputkan Judul Temuan',
                    'temuan Kondisi' => 'Belum menginputkan Kondisi Temuan',
                    'temuan Kriteria' => 'Belum menginputkan Kriteria Temuan',
                    'temuan Sebab' => 'Belum menginputkan Sebab Temuan',
                    'temuan Akibat' => 'Belum menginputkan Akibat Temuan',
                    'temuan kerja_kerja' => 'Belum mengupload Kertas Kerja',
                    'komentar' => 'Belum menginputkan Komentar',
                    'kertas_kerja' => 'Belum mengupload kertas kerja',
                    'kertas_kerja:mimes' => 'Kertas kerja tidak sesuai dengan format, format wajib : DOC, PDF, DOCX, ZIP',
                    'kertas_kerja:max' => 'Ukuran Kerta Kerja terlalu besar, maks: 20MB',
                ]);

                // dd($request->kertas_kerja);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/kinerja';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKinerja::create([
                        'audit_kinerja' => 0,
                        'kode_audit_kinerja' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_kinerja')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0, 
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('audit_kinerja')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_audit_kinerja')->insert([
                    'audit_kinerja' => $data->id,
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

                DB::table('audit')->insert([
                    'created_by' => Auth::user()->id,
                    'audit' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/kinerja';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKinerja::create([
                        'audit_keuangan' => $request->id,
                        'kode_audit_kinerja' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_kinerja')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
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

                DB::table('audit')->insert([
                    'created_by' => Auth::user()->id,
                    'audit' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        } else {
            if($request->has('kirim')) {
                $datacheck = DB::table('audit_kinerja')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/kinerja';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKinerja::create([
                        'audit_keuangan' => $request->id,
                        'kode_audit_kinerja' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_kinerja')->where('id', $request->id)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
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

                DB::table('audit')->where('audit', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $photoname = $photo->getClientOriginalName().rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/kinerja';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditKinerja::create([
                        'audit_keuangan' => $request->id,
                        'kode_audit_kinerja' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_kinerja')->where('id', $request->id)->update([
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_save' => 1,
                    'updated_at' => Carbon::now()
                ]); 
            }     
        };          
                
        return redirect(route('audit').'#audit_kinerja')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve2(Request $request)
    {
        $data =  DB::table('approvel_audit_kinerja as auk')
                ->where('auk.audit_kinerja', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->audit_kinerja == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_kinerja')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->audit_kinerja == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_kinerja')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_kinerja')->where('audit_kinerja', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_kinerja')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Kinerja Berhasil di Setujui']);
                }else {
                } 
            }
        }
    }

    public function delete2($id)
    {
        $gambar = DB::table('kertas_audit_kinerjas')->where('id',$id)->first();
	    File::delete('storage/upload/audit/kinerja/'.$gambar->filename);
        DB::table('kertas_audit_kinerjas')->where('id', $id)->delete();
        return redirect(route('audit'))->with(['success' => 'Kertas Kerja Audit Kinerja Berhasil di Hapus']);      
    }

    ## Audit Tujuan Tertentu ##
    public function post3(Request $request)
    {
        $checkdata = DB::table('audit_tujuan_tertentu')
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',

                ## Form Comment ##
                'komentar' => 'required'
                ],
                [
                    'ketua.required' => 'Belum memlih Ketua Tim',
                    'nomor_st' => 'Belum menginputkan Nomor Surat Tugas',
                    'tanggal_audit_from' => 'Belum menginputkan Tanggal Audit Dari',
                    'tanggal_audit_to' => 'Belum menginputkan Tanggal Audit Sampai',
                    'temuan Judul' => 'Belum menginputkan Judul Temuan',
                    'temuan Kondisi' => 'Belum menginputkan Kondisi Temuan',
                    'temuan Kriteria' => 'Belum menginputkan Kriteria Temuan',
                    'temuan Sebab' => 'Belum menginputkan Sebab Temuan',
                    'temuan Akibat' => 'Belum menginputkan Akibat Temuan',
                    'temuan kerja_kerja' => 'Belum mengupload Kertas Kerja',
                    'komentar' => 'Belum menginputkan Komentar',
                    'kertas_kerja' => 'Belum mengupload kertas kerja',
                    'kertas_kerja:mimes' => 'Kertas kerja tidak sesuai dengan format, format wajib : DOC, PDF, DOCX, ZIP',
                    'kertas_kerja:max' => 'Ukuran Kerta Kerja terlalu besar, maks: 20MB',
                ]
            );

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/tujuantertentu';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditTujuanTertntu::create([
                        'audit_tujuan_tertentu' => $request->id,
                        'kode_audit_tujuan_tertentu' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_tujuan_tertentu')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_publish' => 1,
                    'is_save' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('audit_tujuan_tertentu')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('approvel_audit_tujuan_tertentu')->insert([
                    'audit_tujuan_tertentu' => $data->id,
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

                DB::table('audit')->insert([
                    'created_by' => Auth::user()->id,
                    'audit' => $request->kode,
                    'nomor_st' => $request->nomor_st,
                    'ketua' => $request->ketua,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
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
                'temuan_judul' => 'required',
                'temuan_kondisi' => 'required',
                'temuan_kriteria' => 'required',
                'temuan_sebab' => 'required',
                'temuan_akibat' => 'required',

                ## Form Kertas Kerja ##
                'kertas_kerja' => 'required',
                ]);

                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/tujuantertentu';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditTujuanTertntu::create([
                        'audit_tujuan_tertentu' => $request->id,
                        'kode_audit_tujuan_tertentu' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_tujuan_tertentu')->insert([
                    'kode' => $request->kode,
                    'ketua' => $request->ketua,
                    'nomor_st' => $request->nomor_st,
                    'tanggal_audit_from' => $request->tanggal_audit_from,
                    'tanggal_audit_to' => $request->tanggal_audit_to,
                    'temuan_judul' => $request->temuan_judul,
                    'temuan_kondisi' => $request->temuan_kondisi,
                    'temuan_kriteria' => $request->temuan_kriteria,
                    'temuan_sebab' => $request->temuan_sebab,
                    'temuan_akibat' => $request->temuan_akibat,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'is_save' => 1,
                    'is_publish' => 0,
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
                $datacheck = DB::table('audit_tujuan_tertentu')
                    ->where('id', $request->id)
                    ->first();

                $this->validate($request, 
                [
                    'komentar' => 'required',
                ]);
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/tujuantertentu';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditTujuanTertntu::create([
                        'audit_tujuan_tertentu' => $request->id,
                        'kode_audit_tujuan_tertentu' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_tujuan_tertentu')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_audit_from' => $request->tanggal_audit_from,
                'tanggal_audit_to' => $request->tanggal_audit_to,
                'temuan_judul' => $request->temuan_judul,
                'temuan_kondisi' => $request->temuan_kondisi,
                'temuan_kriteria' => $request->temuan_kriteria,
                'temuan_sebab' => $request->temuan_sebab,
                'temuan_akibat' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_publish' => 1,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
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

                DB::table('audit')->where('audit', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('simpan')) {
                
                foreach ($request->kertas_kerja as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $name = explode(".",$photo->getClientOriginalName());
                    $photoname = $name[0].rand(10000,99999).'.'.$extension;
                    $folder = 'storage/upload/audit/tujuantertentu';
                    $photopath = $folder.$photoname;
                    $photo->move(public_path($folder),$photoname);
                    $data[] = $photoname;
                    KertasAuditTujuanTertntu::create([
                        'audit_tujuan_tertentu' => $request->id,
                        'kode_audit_tujuan_tertentu' => $request->kode,
                        'filename' => $photoname
                    ]);
                }

                DB::table('audit_tujuan_tertentu')->where('id', $request->id)->update([
                'ketua' => $request->ketua,
                'nomor_st' => $request->nomor_st,
                'tanggal_audit_from' => $request->tanggal_audit_from,
                'tanggal_audit_to' => $request->tanggal_audit_to,
                'temuan_judul' => $request->temuan_judul,
                'temuan_kondisi' => $request->temuan_kondisi,
                'temuan_kriteria' => $request->temuan_kriteria,
                'temuan_sebab' => $request->temuan_sebab,
                'temuan_akibat' => $request->temuan_akibat,
                'is_prosess' => 1,
                'is_status' => 1,
                'is_save' => 1,
                'updated_at' => Carbon::now()
                ]); 
            }
        };          
                
        return redirect(route('audit').'#audit_tujuan_tertentu')->with(['success' => 'Pesan Berhasil']);
    }

    public function approve3(Request $request)
    {
        $data =  DB::table('approvel_audit_tujuan_tertentu as auk')
                ->where('auk.audit_tujuan_tertentu', $request->id)
                ->first();

        $this->validate($request, 
        [
            'komentar' => 'required',
        ]);

        if($request->has('kirim')) {
            if($data->audit_tujuan_tertentu == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 2,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit tujuan tertentu Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'status_pt' => 2,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Keuangan Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'status_pm' => 2,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_tujuan_tertentu')->where('id', $request->id)->update([
                        'is_prosess' => 2,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit tujuan tertentu Berhasil di Setujui']);
                }else {

                }
                
            }
        } elseif($request->has('kembali')) {
            if($data->audit_tujuan_tertentu == $request->id) {
                if($data->users_ketua == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'status_pembuat' => 4,
                    'users_pt' => 2,
                    'users_pm' => 3,
                    'status_ketua' => 3,
                    'tanggal_ketua' => Carbon::now()->format('d/m/yy'),
                    'jam_ketua' => Carbon::now()->format('H:m'),
                    'komentar_ketua' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_tujuan_tertentu')->where('id', $request->id)->update([
                        'is_status' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Tujuan Tertentu Berhasil di Setujui']);
                }elseif($data->users_pt == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'status_ketua' => 4,
                    'status_pt' => 3,
                    'tanggal_pt' => Carbon::now()->format('d/m/yy'),
                    'jam_pt' => Carbon::now()->format('H:m'),
                    'komentar_pt' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Tujuan Tertentu Berhasil di Setujui']);
                }elseif($data->users_pm == Auth::user()->id) {
                    DB::table('approvel_audit_tujuan_tertentu')->where('audit_tujuan_tertentu', $request->id)->update([
                    'status_pt' => 4,
                    'status_pm' => 3,
                    'tanggal_pm' => Carbon::now()->format('d/m/yy'),
                    'jam_pm' => Carbon::now()->format('H:m'),
                    'komentar_pm' => $request->komentar,
                    'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit')->where('audit', $request->id)->update([
                        'is_prosess' => 2,
                        'jenis' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    DB::table('audit_keuangan')->where('id', $request->id)->update([
                        'is_status' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                     return redirect(route('audit'))->with(['success' => 'Audit Tujuan Tertentu Berhasil di Setujui']);
                }else {
                } 
            }
        
        }
    }

    public function delete3($id)
    {
        $gambar = DB::table('kertas_audit_tujuan_tertentus')->where('id',$id)->first();
	    File::delete('storage/upload/audit/tujuantertentu/'.$gambar->filename);
        DB::table('kertas_audit_tujuan_tertentus')->where('id', $id)->delete();
        return redirect(route('audit'))->with(['success' => 'Kertas Kerja Audit Kinerja Berhasil di Hapus']);      
    }
}
