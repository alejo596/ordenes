<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FondoFijos;
use App\encargado_cc;
use App\Centros;

class FondoFijosController extends Controller
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
    public function show($id)
    {
        $fondo=FondoFijos::select('anticipos.adjuntos.url',
            'anticipos.solicitudes.id',
            'anticipos.solicitudes.amio',
            'anticipos.solicitudes.fecha_ingresada',
            'anticipos.solicitudes.monto',
            'prespuestos.centrosdecostos.nombre',
            'prespuestos.centro_de_responsabilidad.nombre',
            'anticipos.fiadores.id AS fiador_id',
            'anticipos.fiadores.nombre AS nombre_fiador',
            'gestion_ordenes.solicitudes.id as id_solicitud',
            'gestion_ordenes.solicitudes.tipo')
        ->join('anticipos.adjuntos','anticipos.solicitudes.adjuntos_id','=','anticipos.adjuntos.id')
        ->join('gestion_ordenes.solicitudes','anticipos.solicitudes.id','=','gestion_ordenes.solicitudes.id_doc')
        ->join('prespuestos.centrosdecostos','anticipos.solicitudes.cc','=','prespuestos.centrosdecostos.id')
        ->join('prespuestos.centro_de_responsabilidad','anticipos.solicitudes.cr','=','prespuestos.centro_de_responsabilidad.id')
        ->join('anticipos.fiadores','anticipos.solicitudes.fiador_id','=','anticipos.fiadores.id')
        ->where('gestion_ordenes.solicitudes.tipo',3)
        ->where('gestion_ordenes.solicitudes.id','=',$id)

        ->first();

        return $fondo;
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
        $f=FondoFijos::find($id)->update($request->except('_method', '_token'));
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
