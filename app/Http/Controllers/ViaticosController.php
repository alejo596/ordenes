<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\encargado_cc;
use App\Centros;
use App\Viaticos;
use Illuminate\Support\Facades\DB;

class ViaticosController extends Controller
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
     $viaticos=Viaticos::select('viaticos.viatico.v_num',
        'viaticos.viatico.v_year',
        'viaticos.viatico.v_cc',
        'prespuestos.centrosdecostos.nombre as cc',
        'prespuestos.centro_de_responsabilidad.nombre as cr',
        'viaticos.viatico.v_motivo',
        'viaticos.viatico.v_fecha_inicio',
        'viaticos.viatico.v_fecha_final',
        'viaticos.viatico.v_lugar',
        'viaticos.viatico.v_derecho_psje',
        'viaticos.viatico.v_nombre',
        'viaticos.viatico.v_sistema_run',
        'ssalud.persona.per_nombre',
        'ssalud.persona.per_email',
        'viaticos.viatico.v_d_total',
        'viaticos.viatico.v_sistema_fecha',
        'viaticos.viatico.v_ley_med',
         'viaticos.viatico.v_calidad',
        'gestion_ordenes.encargados_cc.rut_encargado',
        'gestion_ordenes.solicitudes.id_doc',
        'viaticos.region.reg_nombre',
        'viaticos.provincia.prov_nombre')
     ->join('viaticos.region','viaticos.viatico.v_region','=','viaticos.region.reg_id')
      ->join('viaticos.provincia','viaticos.viatico.v_prov','=','viaticos.provincia.prov_id')    
     ->join('gestion_ordenes.solicitudes','viaticos.viatico.v_id','=','gestion_ordenes.solicitudes.id_doc')
     ->join('prespuestos.centrosdecostos','gestion_ordenes.solicitudes.cc','=','prespuestos.centrosdecostos.id')
     ->join('prespuestos.centro_de_responsabilidad','prespuestos.centrosdecostos.cr','=','prespuestos.centro_de_responsabilidad.id')
     ->join('ssalud.persona','viaticos.viatico.v_sistema_run','=',DB::raw('ssalud.persona.per_rut COLLATE utf8_spanish_ci'))
     ->join('gestion_ordenes.encargados_cc','prespuestos.centrosdecostos.id','=','gestion_ordenes.encargados_cc.id_cc')
    ->where('gestion_ordenes.encargados_cc.rut_encargado',$request->run)
     ->where('gestion_ordenes.solicitudes.id_doc','=',$request->id)
     ->get();
     return $viaticos;
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
