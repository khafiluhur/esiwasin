<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $penugasan = DB::table('users as u')
                ->select('u.nama', 'l.nama as level')
                ->join('level as l', 'l.id', '=', 'u.level')
                ->orderBy('u.nama', 'asc')
                ->where('group', Auth::user()->group)
                ->get();

        $permission = DB::table('users as u')
                ->select('u.*', 'p.*')
                ->join('permission as p', 'p.nip', '=', 'u.nip')
                ->where('u.nip', Auth::user()->nip)
                ->first();
        
       // dd($permission);

        $year = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

        // $click = Click::select(DB::raw("SUM(numberofclick) as count"))
        //     ->orderBy("created_at")
        //     ->groupBy(DB::raw("year(created_at)"))
        //     ->get()->toArray();
        // $click = array_column($click, 'count');

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

        // $test = DB::table('audit')
        //         ->select('created_by', DB::raw('count(*) as total'))
        //         ->groupBy('created_by')
        //         ->get();
        // $test = DB::table('audit')
        //         // ->select('created_at', DB::raw('count(*) as total'))
        //         ->groupBy('created_by')
        //         ->get();
        // dd($test);
        // dd($user);

        $page = "home"; 
        return view('home', compact('page', 'penugasan', 'permission'))->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));;
        
    }
}