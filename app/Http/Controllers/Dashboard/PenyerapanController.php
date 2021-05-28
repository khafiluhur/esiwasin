<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenyerapanController extends Controller
{

    public function index()
    {
        $data = DB::table('input_pkpt')->get();
        $jenis = DB::table('jenis')->get(); 

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $page = "penyerapan"; 
        return view('dashboard.penyerapan', compact('page', 'data', 'jenis', 'permission'));
    }

    public function detail($id)
    {
        $data = DB::table('input_pkpt')->where('id', $id)->first();
        $jenis = DB::table('jenis')->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $page = "penyerapan";
        return view('partial.penyerapan.detail', compact('page', 'data', 'jenis', 'permission'));
    }

    public function edit(Request $request, $id)
    {

        $pkpt = DB::table('input_pkpt')->where('id', $id)->first();

        if ($request->has('realisasi') && $request['realisasi']!=null) {
            $data = explode('.',$request['realisasi']);
            DB::table('input_pkpt')->where('id', $id)->update([
            'realisasi' => $data[1],
            'saldo' => $pkpt->biaya - $data[1],
            'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->route('detail.penyerapan', ['id' => $id])->with(['success' => 'Pesan Berhasil']);
    }
}
