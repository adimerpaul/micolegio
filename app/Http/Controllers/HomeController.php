<?php

namespace App\Http\Controllers;

use App\Imports\AlumnosImport;
use App\Imports\CursosImport;
use App\Imports\MateriasImport;
use App\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function import(){
        Excel::import(new UsersImport,request()->file('file'));
        return back();
    }
    public function importmateria(){
        Excel::import(new MateriasImport,request()->file('file'));
        return back();
    }
    public function importcurso(){
        Excel::import(new CursosImport,request()->file('file'));
        return back();
    }
    public function importalumno(){
        Excel::import(new AlumnosImport,request()->file('file'));
        return back();
    }
    public function users(){
        return User::all();
    }
    public function usuario(){
        return Auth::user();
    }
    public function deleteuser($id){
        $user=User::find($id);
        $user->delete();
        return 1;
    }
}
