<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CppLiberar;
use App\Compromisos;
use App\Refrendacion;
use Illuminate\Support\Facades\DB;

class CppLiberarController extends Controller
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
        $d= new CppLiberar();
        $d->cpp=$request->cpp;
        $d->usuario=$request->usuario;
        $d->motivo=$request->motivo;
        $d->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $sql=DB::connection('presupuesto')
      ->select(DB::raw("DELETE
        FROM
        gastos
        WHERE
        id_producto in(SELECT
            gestion_ordenes.producto_compra.pro_id
            FROM
            gestion_ordenes.producto_compra
            where gestion_ordenes.producto_compra.pro_id_cpp=".$id."
        )"));

      $d=DB::connection('ordenes_de_compras')
      ->select(DB::raw("UPDATE
        refrendacion
        set
        gestion_ordenes.refrendacion.monto=gestion_ordenes.refrendacion.monto*-1,
        gestion_ordenes.refrendacion.estado=4
        WHERE
        gestion_ordenes.refrendacion.id_compromiso=".$id));

      $refrendacion=Refrendacion::where('id_compromiso',$id)->first();

      $c=DB::connection('ordenes_de_compras')
      ->select(DB::raw("INSERT 
        INTO
        detalle_refrendacion
        (
            detalle_refrendacion.id_refrendacion,
            detalle_refrendacion.monto,
            detalle_refrendacion.cc,
            detalle_refrendacion.sigfe,
            detalle_refrendacion.id_producto,
            detalle_refrendacion.`year`
            )
        SELECT
        refrendacion.id AS refrendacion,
        sum(producto_compra.pro_total)*-1 as monto,
        producto_compra.pro_cc,
        producto_compra.sigfe_item,
        producto_compra.pro_id,
        producto_compra.pro_amio
        FROM
        producto_compra
        INNER JOIN refrendacion ON producto_compra.pro_id_cpp = refrendacion.id_compromiso
        where producto_compra.pro_id_cpp=".$id."
        GROUP BY
        producto_compra.sigfe_item"));

      $r=DB::connection('ordenes_de_compras')
      ->select(DB::raw("INSERT 
        INTO
        refrendacion_cc
        (
            refrendacion_cc.cc,
            refrendacion_cc.monto,
            refrendacion_cc.`year`,
            refrendacion_cc.sigfe
        )
        SELECT
        producto_compra.pro_cc,
        sum(producto_compra.pro_total)*-1 as monto,
        producto_compra.pro_amio,
        producto_compra.sigfe_item

        FROM
        producto_compra
        where producto_compra.pro_id_cpp=".$id."
        GROUP BY
        producto_compra.sigfe_item "));

      $cpp=Compromisos::where('id',$id)->update(['estado'=>1]);


         return 1;





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
