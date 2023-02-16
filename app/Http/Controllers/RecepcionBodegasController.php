<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecepcionBodegas;

class RecepcionBodegasController extends Controller
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

        $u=RecepcionBodegas::where('year_recepcion',$request->year)->get()->last();


        if(is_null($u)){
            $numero=1;
        }else{
            $numero=$u->numero+1;
        }

        $r=new RecepcionBodegas();
        $r->num_recepcion=$numero;
        $r->year_recepcion=$request->year;
        $r->fecha_ingreso=$request->fechai;
        $r->fecha_recepcion=$request->fechar;
        $r->num_docto=$request->numero;
        $r->tipo_docto=$request->tipo;
        $r->estado_docto=$request->estado;
        $r->proveedor=$request->proveedor;
        
        $r->bodeguero=$request->bodeguero;
        $r->ip_recepcion=\Request::ip();
        $r->n_lic=$request->n_lic;
        $r->obs=$request->obs;
        $r->id_cpp=$request->cpp;
        $r->id_factura=$request->id_factura;
      

        $r->save();

        return $r->id_recepcion;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $r=RecepcionBodegas::select('bodega_inventario.recepcion_bodega.id_recepcion',
            'bodega_inventario.recepcion_bodega.num_recepcion',
            'bodega_inventario.recepcion_bodega.year_recepcion',
            'bodega_inventario.recepcion_bodega.fecha_ingreso',
            'bodega_inventario.recepcion_bodega.fecha_recepcion',
            'bodega_inventario.recepcion_bodega.num_docto',
            'bodega_inventario.recepcion_bodega.tipo_docto',
            'bodega_inventario.recepcion_bodega.estado_docto',
            'bodega_inventario.recepcion_bodega.proveedor',
            'bodega_inventario.recepcion_bodega.programa',
            'bodega_inventario.recepcion_bodega.bodeguero',
            'bodega_inventario.recepcion_bodega.ip_recepcion',
            'bodega_inventario.recepcion_bodega.n_lic',
            'bodega_inventario.recepcion_bodega.obs',
            'bodega_inventario.recepcion_bodega.id_cpp',
            'bodega_inventario.recepcion_bodega.id_factura',
            'bodega_inventario.recepcion_bodega.motivo_no_envio_correo',
            'bodega_inventario.recepcion_bodega.esta_pagada',
            'gestion_ordenes.compromisos.numero')
        ->join('gestion_ordenes.compromisos','bodega_inventario.recepcion_bodega.id_cpp','=','gestion_ordenes.compromisos.id')
        ->where('recepcion_bodega.id_cpp',$id)
        ->first();

        return $r;
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
