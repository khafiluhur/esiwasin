<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Auth;
use Carbon\Carbon;
use App\DasarNodin;
use App\PesertaNotulen;
use Illuminate\Http\Request;
use App\LandasanHukumKepsesjen;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class DokumentasiController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->get(); 
        $jabatan = DB::table('jabatan')->get(); 
        $data = DB::table('input_pkpt')->get();
        $anggota = DB::table('users')
                ->get();  
        $jenis = DB::table('jenis')->get(); 

        $pkpt_notulensi = DB::table('input_pkpt')->where('jenis', 21)->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        ##nodin
        $data1 = DB::table('pengajuan_nodim')
                 ->where('is_status', 1)
                 ->orderBy('created_at')
                 ->first();
        if($data1) {
            $file1 = DB::table('dasar_nodins')
                    ->where('kode_nodin', $data1->kode)
                    ->get();
        }else {
            $file1 = null;
        }
        ##kepsesjen
        $data2 = DB::table('pengajuan_kepseajen')
                 ->where('is_status', 1)
                 ->orderBy('created_at')
                 ->first();
        if($data2) {
            $file2 = DB::table('landasan_hukum_kepsesjens')
                    ->where('kode_kepsesjen', $data2->kode)
                    ->get();
        }else {
            $file2 = null;
        }
        
        $page = "dokumentasi"; 
        return view('dashboard.dokumentasi', compact('page', 'pkpt_notulensi', 'users', 'jabatan', 'data', 'anggota', 'jenis', 'data1', 'file1', 'data2', 'file2', 'permission'));
    }

    ## Dokumentasi NODIN ##
    public function post1(Request $request)
    {
        $checkdata = DB::table('pengajuan_nodim')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'kepada' => 'required',
                'dari' => 'required',
                'dasar' => 'required',
                'tanggal' => 'required',
                'hal' => 'required',
                'isi_nodim' => 'required',
                'nomor' => 'required',
                'kode_arsip' => 'required',
                'tahun' => 'required',
                'tembusan' => 'required'
                ]);
                
                    // dd($request->dasar);
                foreach ($request->dasar  as $dasar) {
                    
                        // dd($key);
                        DasarNodin::create([
                            'kode_nodin' => $request->kode,
                            'dasar' => $dasar
                        ]);
                    
                    
                }

                DB::table('pengajuan_nodim')->insert([
                    'kode' => $request->kode,
                    'kepada' => $request->kepada,
                    'dari' => $request->dari,
                    'tanggal' => $request->tanggal,
                    'hal' => $request->hal,
                    'isi_nodim' => $request->isi_nodim,
                    'nomor' => $request->nomor,
                    'kode_arsip' => $request->kode_arsip,
                    'tahun' => $request->tahun,
                    'nomor_nodim' => "ND-".$request->nomor."/".$request->kode_arsip."/".$request->tahun,
                    'tembusan' => $request->tembusan,
                    'created_by' => Auth::user()->id,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('pengajuan_nodim')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('dokumentasi')->insert([
                    'created_by' => Auth::user()->id,
                    'dokumentasi' => $request->kode,
                    'tentang' => 0,
                    'kepada' => $request->kepada,
                    'tanggal' => $request->tanggal,
                    'nomor_nodim' => "ND-".$request->nomor."/".$request->kode_arsip."/".$request->tahun,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('unduh')) {

                DB::table('pengajuan_nodim')->where('kode', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('dokumentasi')->where('dokumentasi', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                $audit = DB::table('pengajuan_nodim as pk')
                        ->select('pk.*', 'uk.nama as kepada', 'ud.nama as dari')
                        ->join('users as uk', 'uk.id', '=', 'pk.kepada')
                        ->leftjoin('users as ud', 'ud.id', '=', 'pk.dari')
                        ->where('pk.kode', $request->kode)
                        ->first();
                        
                $landasan_hukum = DB::table('dasar_nodins')
                                  ->where('kode_nodin', $audit->kode)
                                  ->get();
                
                $templateProcessor = new TemplateProcessor(public_path('template/nodin.docx'));
                $templateProcessor->setValue('title', "Dokumentasi Nodin");
                $templateProcessor->setValue('nomor', $audit->nomor_nodim);
                $templateProcessor->setValue('kepada', $audit->kepada);
                $templateProcessor->setValue('dari', $audit->dari);
                $templateProcessor->setValue('tanggal', $audit->tanggal);
                $templateProcessor->setValue('hal', $audit->hal);
                $templateProcessor->setValue('isi', $audit->isi_nodim);
                $templateProcessor->setValue('tembusan', $audit->tembusan);
                $templateProcessor->setValue('dasar1', $landasan_hukum[0]->dasar);
                $templateProcessor->setValue('dasar2', $landasan_hukum[1]->dasar);
               
                $filename = 'Dokumentasi Nodin' . $audit->kode;
                $templateProcessor->saveAs($filename . '.docx');
                return response()->download($filename . '.docx')->deleteFileAfterSend(true);
                return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
            }

        } else {
           if($request->has('kirim')) {
            DB::table('pengajuan_nodim')->where('id', $request->id)->update([
                'kode' => $request->kode,
                    'kepada' => $request->kepada,
                    'dari' => $request->dari,
                    'tanggal' => $request->tanggal,
                    'hal' => $request->hal,
                    'isi_nodim' => $request->is_nodim,
                    'nomor' => $request->nomor,
                    'kode_arsip' => $request->kode_arsip,
                    'tahun' => $request->tahun,
                    'nomor_nodim' => "ND-".$request->nomor."/".$request->kode_arsip."/".$request->tahun,
                'updated_at' => Carbon::now()
                ]); 

                DB::table('dokuemntasi')->where('dokumentasi', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('unduh')) {

                DB::table('pengajuan_nodim')->where('kode', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('dokumentasi')->where('dokumentasi', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                $audit = DB::table('pengajuan_nodim as pk')
                        ->select('pk.*', 'uk.nama as kepada', 'ud.nama as dari')
                        ->join('users as uk', 'uk.id', '=', 'pk.kepada')
                        ->leftjoin('users as ud', 'ud.id', '=', 'pk.dari')
                        ->where('pk.kode', $request->kode)
                        ->first();
                $landasan_hukum = DB::table('dasar_nodins')
                                  ->where('kode_nodin', $audit->kode)
                                  ->get();
                
                $templateProcessor = new TemplateProcessor(public_path('template/nodin.docx'));
                $templateProcessor->setValue('title', "Dokumentasi Nodin");
                $templateProcessor->setValue('nomor', $audit->nomor_nodim);
                $templateProcessor->setValue('kepada', $audit->kepada);
                $templateProcessor->setValue('dari', $audit->dari);
                $templateProcessor->setValue('tanggal', $audit->tanggal);
                $templateProcessor->setValue('hal', $audit->hal);
                $templateProcessor->setValue('isi', $audit->isi_nodim);
                $templateProcessor->setValue('tembusan', $audit->tembusan);
                $templateProcessor->setValue('dasar1', $landasan_hukum[0]->dasar);
                $templateProcessor->setValue('dasar2', $landasan_hukum[1]->dasar);
               
                $filename = 'Dokumentasi Nodin' . $audit->kode;
                $templateProcessor->saveAs($filename . '.docx');
                return response()->download($filename . '.docx')->deleteFileAfterSend(true);
                return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
            } 
        };          
                
        return redirect(route('dokumentasi').'#dokumentasi_nodin')->with(['success' => 'Pesan Berhasil']);
    }

    ## Dokumentasi Kepsesjen ##
    public function post2(Request $request)
    {
        $checkdata = DB::table('pengajuan_kepseajen')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'kepada' => 'required',
                'dari' => 'required',
                'tentang' => 'required',
                'tanggal' => 'required',
                'pejabat' => 'required',
                'jabatan' => 'required',
                'landasan' => 'required',
                'catatan' => 'required',
                'lampiran' => 'required',
                'nomor_kepsesjen' => 'required',
                'tahun_kepsesjen' => 'required'
                ]);

                foreach ($request->landasan as $dasar) {
                    LandasanHukumKepsesjen::create([
                        'kode_kepsesjen' => $request->kode,
                        'landasan_hukum' => $dasar
                    ]);
                }

                DB::table('pengajuan_kepseajen')->insert([
                    'kode' => $request->kode,
                    'kepada' => $request->kepada,
                    'dari' => $request->dari,
                    'tentang' => $request->tentang,
                    'tanggal' => $request->tanggal,
                    'pejabat' => $request->pejabat,
                    'jabatan' => $request->jabatan,
                    'catatan' => $request->catatan,
                    'lampiran' => $request->lampiran,
                    'nomor_kepsesjen' => 'Persesjen-'.$request->nomor_kepsesjen.'/'.$request->tahun_kepsesjen,
                    'nomor' => $request->nomor_kepsesjen,
                    'tahun' => $request->tahun_kepsesjen,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $data = DB::table('pengajuan_kepseajen')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                DB::table('dokumentasi')->insert([
                    'created_by' => Auth::user()->id,
                    'dokumentasi' => $request->kode,
                    'kepada' => $request->kepada,
                    'tentang' => $request->tentang,
                    'tanggal' => $request->tanggal,
                    'nomor_nodim' => 'Persesjen-'.$request->nomor_kepsesjen.'/'.$request->tahun_kepsesjen,
                    'is_prosess' => 1,
                    'is_status' => 0,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('unduh')) {

                DB::table('pengajuan_kepseajen')->where('kode', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('dokumentasi')->where('dokumentasi', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                $audit = DB::table('pengajuan_kepseajen as pk')
                        ->select('pk.*', 'uk.nama as kepada', 'ud.nama as dari', 'up.nama as pejabat', 'j.nama as jabatan')
                        ->join('users as uk', 'uk.id', '=', 'pk.kepada')
                        ->leftjoin('users as ud', 'ud.id', '=', 'pk.dari')
                        ->leftjoin('users as up', 'up.id', '=', 'pk.pejabat')
                        ->leftjoin('jabatan as j', 'j.id', '=', 'pk.jabatan')
                        ->where('pk.kode', $request->kode)
                        ->first();
                $landasan_hukum = DB::table('landasan_hukum_kepsesjens')
                                  ->where('kode_kepsesjen', $audit->kode)
                                  ->get();
                
                // dd(public_path('/template/kepsesjen.docx'));
                $templateProcessor = new TemplateProcessor(public_path('/template/kepsesjen.docx'));
                $templateProcessor->setValue('title', "Dokumentasi Kepsesjen");
                $templateProcessor->setValue('nomor', $audit->nomor_kepsesjen);
                $templateProcessor->setValue('kepada', $audit->kepada);
                $templateProcessor->setValue('dari', $audit->dari);
                $templateProcessor->setValue('tanggal', $audit->tanggal);
                $templateProcessor->setValue('pejabat', $audit->pejabat);
                $templateProcessor->setValue('jabatan', $audit->jabatan);
                $templateProcessor->setValue('isi', $audit->catatan);
                $templateProcessor->setValue('lampiran', $audit->lampiran);
                $templateProcessor->setValue('landasan_hukum1', $landasan_hukum[0]->landasan_hukum);
                $templateProcessor->setValue('landasan_hukum2', $landasan_hukum[1]->landasan_hukum);
               
                $filename = 'Dokumentasi Kepsesjen' . $audit->kode;
                $templateProcessor->saveAs($filename . '.docx');
                return response()->download($filename . '.docx')->deleteFileAfterSend(true);
                return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
            }

        } else {
           if($request->has('kirim')) {               
            DB::table('pengajuan_kepseajen')->where('id', $request->id)->update([
                'kode' => $request->kode,
                    'kepada' => $request->ketua,
                    'dari' => $request->anggota,
                    'tentang' => $request->tentang,
                    'tanggal' => $request->tanggal,
                    'pejabat' => $request->pejabat,
                    'jabatan' => $request->jabatan,
                    'catatan' => $request->catatan_nodim,
                    'lampiran' => $request->catatan_nodim,
                    'nomor_kepsesjen' => 'Persesjen-'.$request->nomor_kepsesjen.'/'.$request->tahun_kepsesjen,
                    'nomor' => $request->nomor_kepsesjen,
                    'tahun' => $request->tahun_kepsesjen,
                    'is_prosess' => 1,
                    'is_status' => 1,
                    'created_by' => Auth::user()->id,
                    'updated_at' => Carbon::now()
                ]); 

                DB::table('dokuemntasi')->where('dokumentasi', $request->id)->update([
                    'is_prosess' => 1,
                    'jenis' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } elseif($request->has('unduh')) {
                DB::table('pengajuan_kepseajen')->where('kode', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                DB::table('dokumentasi')->where('dokumentasi', $request->kode)->update([
                    'is_status' => 0,
                    'updated_at' => Carbon::now()
                ]);

                $audit = DB::table('pengajuan_kepseajen as pk')
                        ->select('pk.*', 'uk.nama as kepada', 'ud.nama as dari', 'up.nama as pejabat', 'j.nama as jabatan')
                        ->join('users as uk', 'uk.id', '=', 'pk.kepada')
                        ->leftjoin('users as ud', 'ud.id', '=', 'pk.dari')
                        ->leftjoin('users as up', 'up.id', '=', 'pk.pejabat')
                        ->leftjoin('jabatan as j', 'j.id', '=', 'pk.jabatan')
                        ->where('pk.kode', $request->kode)
                        ->first();
                $landasan_hukum = DB::table('landasan_hukum_kepsesjens')
                                  ->where('kode_kepsesjen', $audit->kode)
                                  ->get();
                
                $templateProcessor = new TemplateProcessor(public_path('template/kepsesjen.docx'));
                $templateProcessor->setValue('title', "Dokumentasi Kepsesjen");
                $templateProcessor->setValue('nomor', $audit->nomor_kepsesjen);
                $templateProcessor->setValue('kepada', $audit->kepada);
                $templateProcessor->setValue('dari', $audit->dari);
                $templateProcessor->setValue('tanggal', $audit->tanggal);
                $templateProcessor->setValue('pejabat', $audit->pejabat);
                $templateProcessor->setValue('jabatan', $audit->jabatan);
                $templateProcessor->setValue('isi', $audit->catatan);
                $templateProcessor->setValue('lampiran', $audit->lampiran);
                $templateProcessor->setValue('landasan_hukum1', $landasan_hukum[0]->landasan_hukum);
                $templateProcessor->setValue('landasan_hukum2', $landasan_hukum[1]->landasan_hukum);
               
                $filename = 'Dokumentasi Kepsesjen' . $audit->kode;
                $templateProcessor->saveAs($filename . '.docx');
                return response()->download($filename . '.docx')->deleteFileAfterSend(true);
                return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
            }
        };     
                
        return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
    }

    ## Dokumentasi PKPT ##
    public function post3(Request $request)
    {
            $this->validate($request, [
            ## Form Request ##
            'kegiatan' => 'required',
            'uraian_kegiatan' => 'required',
            'mak' => 'required',
            'volume' => 'required',
            ]);

            DB::table('input_pkpt')->insert([
                'kegiatan' => $request->kegiatan,
                'uraian_kegiatan' => $request->uraian_kegiatan,
                'mak' => $request->mak,
                'jenis' => $request->jenis,
                'biaya' => $request->biaya,
                'output' => $request->output,
                'volume' => $request->volume,
                'anggaran' => $request->anggaran,
                'realisasi' => $request->realisasi,
                'saldo' => $request->biaya,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);                            
                
        return redirect(route('dokumentasi').'#dokumentasi_pkpt')->with(['success' => 'Pesan Berhasil']);
    }

    ## Dokumentasi notullensi ##
    public function post4(Request $request)
    {
        $checkdata = DB::table('notullensi')
                    ->where('id', $request->id)
                    ->first();
        
        if($checkdata == null) {
            if($request->has('kirim')) {
                $this->validate($request, [
                ## Form Request ##
                'nomor' => 'required',
                'hari' => 'required',
                'tanggal' => 'required',
                'pukul' => 'required',
                'tempat' => 'required',
                'pimpinan' => 'required',
                'peserta' => 'required',
                'catatan' => 'required',
                'lampiran' => 'required',
                'kesimpualan' => 'required'
                ]);

                // dd($request->peserta);

                foreach ($request->peserta as $peserta) {
                    PesertaNotulen::create([
                        'kode_notulen' => $request->kode,
                        'users' => $peserta
                    ]);
                }

                DB::table('notullensi')->insert([
                    'kode' => $request->kode,
                    'nomor' => $request->nomor,
                    'hari' => $request->hari,
                    'tanggal' => $request->tanggal,
                    'pukul' => $request->pukul,
                    'tempat' => $request->tempat,
                    'pimpinan' => $request->pimpinan,
                    'catatan' => $request->catatan,
                    'lampiran' => $request->lampiran,
                    'kesimpualan' => $request->kesimpualan,
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

                $data = DB::table('notullensi')
                        ->select('id')
                        ->where('kode', $request->kode)
                        ->first();                        

                // DB::table('dokumentasi')->insert([
                //     'created_by' => Auth::user()->id,
                //     'dokumentasi' => $data->id,
                //     'kepada' => $request->kepada,
                //     'tentang' => $request->tentang,
                //     'tanggal' => $request->tanggal,
                //     'nomor' => 0,
                //     'is_prosess' => 1,
                //     'jenis' => 1,
                //     'created_at' => Carbon::now(),
                //     'updated_at' => Carbon::now()
                // ]);
            } elseif($request->has('unduh')) {

            }

        } else {
           if($request->has('kirim')) {
            DB::table('notullensi')->where('id', $request->id)->update([
                'kode' => $request->kode,
                'nomor' => $request->nomor,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'pukul' => $request->pukul,
                'pimpinan' => $request->pimpinan,
                'tempat' => $request->tempat,
                'catatan' => $request->catatan,
                'lampiran' => $request->lampiran,
                'kesimpualan' => $request->kesimpualan,
                'is_prosess' => 1,
                'is_status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]); 

                // DB::table('dokuemntasi')->where('dokumentasi', $request->id)->update([
                //     'is_prosess' => 1,
                //     'jenis' => 1,
                //     'created_at' => Carbon::now(),
                //     'updated_at' => Carbon::now()
                // ]);
            } elseif($request->has('unduh')) {

            }
        };     
                
        return redirect(route('dokumentasi').'#dokumentasi_kepsesjen')->with(['success' => 'Pesan Berhasil']);
    }

    ## Dokumentasi Detail PKPT##
    public function getById($id)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        $data = DB::table('input_pkpt')->where('id', '=', $id)->get();
        $jenis = DB::table('jenis')->get(); 
        // dd($data);
        
        $page = "dokumentasi";
        return view('partial.dokumentasi.pkpt.detail', compact('page', 'data', 'jenis', 'permission'));
    }

    ## Dokumentasi Edit PKPT ##
    public function edit(Request $request, $id)
    {
        $data = DB::table('input_pkpt')->where('id', '=', $id)->first();
        DB::table('input_pkpt')->where('id', $id)->update([
                'saldo' => $data->biaya - $request->realisasi,
                'realisasi' => $request->realisasi,
                'realisasi_output' => $request->realisasi_output,
                'updated_at' => Carbon::now()
                ]); 
        return redirect()->route('detail.pkpt.dokumentasi', ['id' => $id])->with(['success' => 'Pesan Berhasil']);
    }

    public function delete($id)
    {
        // DB::delete('input_pkpt')->where('id', $id)
        DB::delete('delete from input_pkpt where id = ?',[$id]);
        return redirect()->route('detail.pkpt.dokumentasi', ['id' => $id])->with(['success' => 'Pesan Berhasil']);
    }
}
