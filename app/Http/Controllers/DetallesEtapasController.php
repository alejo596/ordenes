<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetallesEtapas;

class DetallesEtapasController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show2($id)
    {
        $d=DetallesEtapas::select('procesos.id as procesos',
            'detalle_etapas.nombre',
            'detalle_etapas.dias',
            'detalle_etapas.id',
            'detalle_etapas.verificar',
            'etapas.nombre as proceso',
            'detalle_etapas.id')
        ->join('etapas','detalle_etapas.id_etapa','=','etapas.id')
        ->join('procesos','procesos.etapa','=','etapas.id')
        ->where('procesos.id',$id)
        
        ->get();
        return $d;

    }
    public function show($id)
    {
        $d=DetallesEtapas::where('id_etapa',$id)->get();
        return $d;
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
