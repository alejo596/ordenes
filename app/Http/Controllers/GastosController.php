<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastos;
use Illuminate\Support\Facades\DB;

class GastosController extends Controller
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
        $g=Gastos::where('familia',$request->familia)->where('cr','=',$request->cr)->where('estado','=',$request->estado)->where('year','=',$request->year)->sum('monto');
        return $g;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $g=Gastos::select(
            'prespuestos.centro_de_responsabilidad.nombre as cr',
            'prespuestos.centrosdecostos.id',
            'prespuestos.centrosdecostos.nombre as cc',
            'gestion_ordenes.producto_compra.pro_id',
            'gestion_ordenes.producto_compra.pro_nombre_sigfe',          
            'prespuestos.gastos.cr as id_cr',
            'prespuestos.gastos.sub_sigfe',
            'prespuestos.gastos.sigfe',
             'prespuestos.gastos.monto')
            ->join('prespuestos.centro_de_responsabilidad','prespuestos.gastos.cr','=','prespuestos.centro_de_responsabilidad.id')
            ->join('prespuestos.centrosdecostos','prespuestos.gastos.cc','=','prespuestos.centrosdecostos.id')
            ->join('gestion_ordenes.producto_compra','prespuestos.gastos.id_producto','=','gestion_ordenes.producto_compra.pro_id')
            ->where('cpp',$id)
            ->Sum('prespuestos.gastos.monto')
            ->orderby('prespuestos.gastos.cr','desc')
            ->get();
        return $g;
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
        Gastos::where('id_producto',$id)->update($request->except('_method', '_token'));
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
