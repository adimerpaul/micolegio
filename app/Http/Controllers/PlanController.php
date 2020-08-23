<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Ramsey\Uuid\v1;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
//        if ($request->hasFile('avatar')) {
//            // Si es así , almacenamos en la carpeta public/avatars
//            // esta estará dentro de public/defaults/
////            $url = $request->avatar->store('users/avatar');
////            $userAvatarUpdate = User::find(auth()->id());
//            /** Áctualización y
//            return JSON*/
//        }
//        return "Noo Llego una imagen";
        $file=$request->file('avatar')->store('archivos');
//        return $file;
        $plan=new Plan();
        $plan->nombre=$request->nombre;
        $plan->tipo=$request->tipo;
        $plan->nota=0;
        $plan->enviado="";
        $plan->archivo=$file;
        $plan->assign_id=$request->assign_id;
        $plan->save();
//        dd("subido y guardado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select(DB::raw("
        SELECT *,(SELECT t.nota FROM  tareas t WHERE t.plan_id= p.id AND t.user_id='".Auth::user()->id."' ) tarea
        FROM plans p
        WHERE p.assign_id='$id'

        "));
//        return DB::table('plans')->where('assign_id','=',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan=Plan::find($id);
        $plan->delete();
        return 1;
    }
}
