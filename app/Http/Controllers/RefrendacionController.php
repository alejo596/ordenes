<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Refrendacion;
use App\Refrendacio_envios;
use App\Productos;

class RefrendacionController extends Controller
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
        $r=new Refrendacion();
        $r->id_compromiso=$request->cpp;
        $r->estado=$request->estado;
        $r->envio=$request->usuario;
        $r->fecha_envio=$request->fecha;
        $r->monto=$request->monto;
        $r->year=$request->year;
        $r->save();

        return $r->id;

    }
    public function store3(Request $request)
    {
      // $r=Refrendacion::where('year',$request->year)
      // ->where('cc','=',$request->cc)->where('estado','=',1)
      // ->where('sigfe','=',$request->sigfe)
      // ->sum('monto');
      //   return $r;
        $p=Refrendacion::join('detalle_refrendacion','refrendacion.id','=','detalle_refrendacion.id_refrendacion')
        ->where('detalle_refrendacion.year',$request->year)
        ->where('detalle_refrendacion.cc','=',$request->cc)
        ->where('detalle_refrendacion.sigfe','=',$request->sigfe)
        ->whereIn('refrendacion.estado',[3,4])
        ->sum('detalle_refrendacion.monto');

        return $p;

    }

    public function store2(Request $request)
    {

        $p=Refrendacio_envios::join('refrendacion','refrendacion.id','=','detalle_refrendacion.id_refrendacion')
        ->where('detalle_refrendacion.year',$request->year)
        ->where('detalle_refrendacion.cc','=',$request->cc)        
        ->where('detalle_refrendacion.sigfe','=',$request->sigfe)
        ->where('refrendacion.estado','=',1)
        ->groupBy('detalle_refrendacion.cc')
        ->sum('detalle_refrendacion.monto');

        $po=Productos::whereIn('producto_compra.pro_estado_producto',[0,1,2,3])
        ->where('producto_compra.pro_amio',$request->year)
        ->where('producto_compra.pro_cc',$request->cc)
        ->where('producto_compra.sigfe_item','=',$request->sigfe)
        ->sum('producto_compra.pro_total');


        $total=intval($p)+intval($po);
        return $total;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
     $r=Refrendacion::where('id_compromiso',$id)->first();
     return $r;
 }    
 public function show($id)
 {
    $r=Refrendacion::where('id_compromiso',$id)->whereNotNull('encargado')->first();
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
