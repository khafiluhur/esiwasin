<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        $page = "login"; 
        return view('auth.login', compact('page'));
        if(!Session::get('login')){
            return view('auth.login')->with('alert','Kamu harus login dulu');
        } else {
            return redirect()->route('home');
        }
        
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['nip' => $request->nip, 'password' => $request->password])) {
            $data = User::where('nip', $request->nip)->first();
            if($data->is_logging == 0) {
                if($data->is_active == 1) {
                    DB::update('update users set updated_at = ?, is_logging = ? where id = ?',[Carbon::now(), 1, $data->id]);
                    return redirect()->route('home');    
                } else {
                    return back()->with('alert', 'Akun Belum Aktif.');
                }
            } else {
                return back()->with('alert', 'Akun Anda Sudah Masuk di perangkat lain.'); 
            }
            
        }else{
            return back()->with('alert', 'No Induk Pegawai dan Password Tidak Ditemukan.');
        }
    }

    public function editProfile(Request $request)
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $page = "profie";
        return view('auth.editprofile', compact('page', 'permission'));
    }

    public function profile(Request $request)
    {
        $users = DB::table('users as u')
                 ->select('u.*', 'j.nama as jabatan', 'l.nama as level')
                 ->join('level as l', 'u.level', '=', 'l.id')
                 ->join('jabatan as j', 'u.jabatan', '=', 'j.id')
                 ->where('u.id', Auth::user()->id)
                 ->first();
        
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $page = "profie";
        return view('auth.profile', compact('page', 'users', 'permission'));
    }

    public function changePassword(Request $request)
    {
        // $request->validate([
        //     'current_password' => ['required'],
        //     'new_password' => ['required'],
        //     'new_confirm_password' => ['same:new_password'],
        // ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return back()->with('alert', 'Password Berhasil Di rubah.');
    }

    public function setting()
    {
        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();

        $page = "profie";
        return view('auth.setting', compact('page', 'permission'));
    }

    public function logout()
    {
        $data = Auth::user();
        // dd($data);
        DB::update('update users set updated_at = ?, is_logging = ? where id = ?',[Carbon::now(), 0, $data->id]);
        return redirect()->route('index');
    }
    //
}
