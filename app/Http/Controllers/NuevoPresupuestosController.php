<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NuevoPresupuestos;

class NuevoPresupuestosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store2(Request $request)
    {
     $p=NuevoPresupuestos::where('cr','=',$request->cr)->where('amio','=',$request->year)->sum('monto');
 
        return $p;
    }
   
    public function store(Request $request)
    {
        $p=NuevoPresupuestos::where('cc',$request->cc)->where('sigfe','=',$request->sigfe)->where('amio','=',$request->amio)->first();
         $valor=empty($p) ? 0: $p;
        return $valor;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p=NuevoPresupuestos::where('cc',$id)->first();
        return $p;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
