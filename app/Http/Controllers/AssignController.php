<?php

namespace App\Http\Controllers;

use App\Assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select(DB::raw("
        SELECT a.id,c.nombre as curso,m.nombre as materia
        FROM assigns a
        INNER JOIN users u ON a.user_id=u.id
        INNER JOIN cursos c ON a.curso_id=c.id
        INNER JOIN materias m ON a.materia_id=m.id
        WHERE c.abreviatura='".Auth::user()->curso."'
        "));
//        return Auth::user()->curso;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assign= new Assign();
        $assign->user_id=$request->user_id;
        $assign->curso_id=$request->curso_id;
        $assign->materia_id=$request->materia_id;
        $assign->save();
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return DB::table('assigns')->where('user_id','=',$id)->get();
        return DB::select(DB::raw("
SELECT a.id,c.nombre as curso,m.nombre as materia
FROM assigns a
INNER JOIN users u ON a.user_id=u.id
INNER JOIN cursos c ON a.curso_id=c.id
INNER JOIN materias m ON a.materia_id=m.id
WHERE a.user_id=$id"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function edit(Assign $assign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assign $assign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assign=Assign::find($id);
        $assign->delete();
        return 1;
    }
    public function materiasdocente(){
        return DB::select(DB::raw("
        SELECT a.id,c.nombre as curso,m.nombre as materia
        FROM assigns a
        INNER JOIN users u ON a.user_id=u.id
        INNER JOIN cursos c ON a.curso_id=c.id
        INNER JOIN materias m ON a.materia_id=m.id
        WHERE a.user_id='".Auth::user()->id."'
        "));
    }
}
