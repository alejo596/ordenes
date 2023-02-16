<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log_historial;
class Log_historialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h=Log_historial::all();
        return $h;
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

        $h=new Log_historial();
        $h->proceso=$request->proceso;
        $h->id_producto=$request->id_producto;
        $h->estado=$request->estado;
        $h->save();
        return $h->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $h=Log_historial::select('log_historial.id',
            'log_historial.proceso',
            'log_historial.id_producto',
            'log_historial.estado',
            'procesos.id AS id_procesos',
            'procesos.observacion',
            'estado_proceso_compra.nombre',
            'procesos.created_at as fecha_inicio',
            'etapas.nombre as nombre_etapa',
            'etapas.id as id_etapa',
            'etapas.total')
        ->join('producto_compra','log_historial.id_producto','=','producto_compra.pro_id')
        ->join('procesos','log_historial.proceso','=','procesos.id')
        ->join('estado_proceso_compra','procesos.estado','=','estado_proceso_compra.id')
        ->join('etapas','procesos.etapa','=','etapas.id')
        ->where('log_historial.id_producto',$id)
        ->get();
        return $h;
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
