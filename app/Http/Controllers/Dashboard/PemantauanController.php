<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemantauanController extends Controller
{

    public function index()
    {
        $golongan = DB::table('golongan')->get();
        $pangkat = DB::table('pangkat')->get();

        $pkpt_bpk = DB::table('input_pkpt')->where('jenis', 12)->get();
        $pkpt_lha = DB::table('input_pkpt')->where('jenis', 13)->get();
        $pkpt_spip = DB::table('input_pkpt')->where('jenis', 14)->get();
        $pkpt_lhkasn = DB::table('input_pkpt')->where('jenis', 15)->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $data1 = DB::table('pemantauan_bpk')->get();
        $data2 = DB::table('pemantauan_lha')->get();
        $data3 = DB::table('pemantauan_spip')->get();
        $data4 = DB::table('pemantauan_lhkasn as pl')
                ->select('pl.*', 'g.nama as golongan', 'p.nama as pangkat')
                ->join('golongan as g', 'pl.id', '=', 'g.id' )
                ->leftjoin('pangkat as p', 'pl.id', '=', 'p.id')
                ->get();

        $page = "pemantauan"; 
        return view('dashboard.pemantauan', compact('page', 'pkpt_bpk', 'pkpt_lha', 'pkpt_spip', 'pkpt_lhkasn', 'golongan', 'pangkat', 'data1', 'data2', 'data3', 'data4','permission'));
    }

    ## Pemantauan TL BPK ##
    public function post1(Request $request)
    {
        $this->validate($request, [
        ## Form Request ##
        'keterangan' => 'required',
        'berkas' => 'required',
        'berkas.*' => 'mimes:doc,pdf,docx,zip',
        'tanggal' => 'required',
        'status' => 'required'
        ]);

        // if($request->berkas as $photo){
        $photo = $request->file('berkas');
        $extension = $photo->getClientOriginalExtension();
        $photoname = $photo->getClientOriginalName();
        $folder = 'storage/upload/pemantauan/bpk';
        $photopath = $folder.$photoname;
        $photo->move(public_path($folder),$photoname);
        // }

        //  dd($photoname);
        

        DB::table('pemantauan_bpk')->insert([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'berkas_temuan' => $photoname,
            'tanggal' => $request->tanggal,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

        DB::table('pemantauan')->insert([
                'pemantauan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pemantauan_from' => $request->tanggal,
                'tanggal_pemantauan_to' => $request->tahun,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 1
        ]);

        return redirect(route('pemantauan'))->with(['success' => 'Pemantauan BPK Berhasil di Setujui']);
    }

    ## Pemantauan TL LHA ##
    public function post2(Request $request)
    {
        $this->validate($request, [
        ## Form Request ##
        'keterangan' => 'required',
        'berkas' => 'required',
        'berkas.*' => 'mimes:doc,pdf,docx,zip',
        'tanggal' => 'required',
        'status' => 'required'
        ]);


        $photo = $request->file('berkas');
        $extension = $photo->getClientOriginalExtension();
        $photoname = $photo->getClientOriginalName();
        $folder = 'storage/upload/pemantauan/lha';
        $photopath = $folder.$photoname;
        $photo->move(public_path($folder),$photoname);
        

        DB::table('pemantauan_lha')->insert([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'berkas_temuan' => $photoname,
            'tanggal' => $request->tanggal,
            'tahun' =>  $request->tahun,
            'status' => $request->status,
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

        DB::table('pemantauan')->insert([
                'pemantauan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pemantauan_from' => $request->tanggal,
                'tanggal_pemantauan_to' => $request->tahun,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 2
        ]);

        return redirect(route('pemantauan'))->with(['success' => 'Pemantauan LHA Berhasil di Setujui']);
    }

    ## Pemantauan SPIP ##
    public function post3(Request $request)
    {
        $this->validate($request, [
        ## Form Request ##
        'keterangan' => 'required',
        'berkas' => 'required',
        'berkas.*' => 'mimes:doc,pdf,docx,zip',
        'tanggal' => 'required',
        'status' => 'required'
        ]);

        $photo = $request->file('berkas');
        $extension = $photo->getClientOriginalExtension();
        $photoname = $photo->getClientOriginalName();
        $folder = 'storage/upload/pemantauan/spip';
        $photopath = $folder.$photoname;
        $photo->move(public_path($folder),$photoname);
        

        DB::table('pemantauan_spip')->insert([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'berkas_temuan' => $photoname,
            'tanggal' => $request->tanggal,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

        DB::table('pemantauan')->insert([
                'pemantauan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pemantauan_from' => $request->tanggal,
                'tanggal_pemantauan_to' => $request->tahun,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 3
        ]);

        return redirect(route('pemantauan'))->with(['success' => 'Pemantauan SPIP Berhasil di Setujui']);
    }

    ## Pemantauan LHKASN ##
    public function post4(Request $request)
    {
        $this->validate($request, [
        ## Form Request ##
        'keterangan' => 'required',
        'golongan' => 'required',
        'pangkat' => 'required',
        'berkas' => 'required',
        'berkas.*' => 'mimes:doc,pdf,docx,zip',
        'tanggal' => 'required',
        'status' => 'required'
        ]);

        $photo = $request->file('berkas');
        $extension = $photo->getClientOriginalExtension();
        $photoname = $photo->getClientOriginalName();
        $folder = 'storage/upload/pemantauan/lhkasn';
        $photopath = $folder.$photoname;
        $photo->move(public_path($folder),$photoname);
        

        DB::table('pemantauan_lhkasn')->insert([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'berkas_temuan' => $photoname,
            'tanggal' => $request->tanggal,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('foreign_pkpt')->insert([
                    'kode' => $request->kode,
                    'pkpt' => $request->pkpt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

        DB::table('pemantauan')->insert([
                'pemantauan' => $request->kode,
                'created_by' => Auth::user()->id,
                'tanggal_pemantauan_from' => $request->tanggal,
                'tanggal_pemantauan_to' => $request->tahun,
                'ketua' => 0,
                'is_prosess' => 1,
                'jenis' => 4
        ]);

        return redirect(route('pemantauan'))->with(['success' => 'Pemantauan LHKASN Berhasil di Setujui']);
    }
}
