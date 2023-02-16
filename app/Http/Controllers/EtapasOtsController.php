<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EtapasOts;

class EtapasOtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $e=EtapasOts::select('detalle_etapas.dias','etapas_ots.comprador', 'etapas_ots.id', 'etapas_ots.oc', 'etapas_ots.id_procesos', 'etapas_ots.etapa', 'etapas_ots.estado', 'etapas_ots.fecha_inicio', 'etapas_ots.detalle_etapa', 'etapas_ots.fecha_termino', 'etapas_ots.created_at', 'etapas_ots.updated_at', 'etapas_ots.proceso', 'funcionarios_compra.per_nombre', 'etapas.nombre', 'detalle_etapas.nombre as nombre_detalle')
        ->join('funcionarios_compra','etapas_ots.comprador','=','funcionarios_compra.per_id')
        ->join('etapas','etapas_ots.etapa','=','etapas.id')
        ->leftJoin('detalle_etapas','etapas_ots.detalle_etapa','=','detalle_etapas.id')
        
        ->get();
        return $e;
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
        $e=new EtapasOts();
       
        $e->id_procesos=$request->detalle;
        $e->etapa=$request->etapa;
        $e->comprador=$request->comprador;
        $e->fecha_inicio=$request->fecha_i;
        $e->detalle_etapa=$request->detalle_etapa;
        $e->fecha_termino=$request->fecha_t;
        $e->proceso=$request->proceso;
        $e->fecha_realizado=$request->fecha_i;
        $e->estado=$request->estado;
        $e->save();

        return $e->id;
    }

       public function store1(Request $request)
    {
         $e=EtapasOts::select('detalle_etapas.dias','etapas_ots.comprador', 'etapas_ots.id', 'etapas_ots.oc', 'etapas_ots.id_procesos', 'etapas_ots.etapa', 'etapas_ots.estado', 'etapas_ots.fecha_inicio', 'etapas_ots.detalle_etapa', 'etapas_ots.fecha_termino', 'etapas_ots.created_at', 'etapas_ots.updated_at', 'etapas_ots.proceso', 'funcionarios_compra.per_nombre', 'etapas.nombre', 'detalle_etapas.nombre as nombre_detalle','etapas_ots.fecha_realizado')
        ->join('funcionarios_compra','etapas_ots.comprador','=','funcionarios_compra.per_id')
        ->join('etapas','etapas_ots.etapa','=','etapas.id')
        ->leftJoin('detalle_etapas','etapas_ots.detalle_etapa','=','detalle_etapas.id')
        ->where('etapas_ots.id_procesos',$request->id)
        ->where('etapas_ots.etapa','=',$request->etapa)
        ->get();

        return $e;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show3($id)
    {
        $e=EtapasOts::select('detalle_etapas.dias','etapas_ots.comprador', 'etapas_ots.id', 'etapas_ots.oc', 'etapas_ots.id_procesos', 'etapas_ots.etapa', 'etapas_ots.estado', 'etapas_ots.fecha_inicio', 'etapas_ots.detalle_etapa', 'etapas_ots.fecha_termino', 'etapas_ots.created_at', 'etapas_ots.updated_at', 'etapas_ots.proceso', 'funcionarios_compra.per_nombre', 'etapas.nombre', 'detalle_etapas.nombre as nombre_detalle')
        ->join('funcionarios_compra','etapas_ots.comprador','=','funcionarios_compra.per_id')
        ->join('etapas','etapas_ots.etapa','=','etapas.id')
        ->leftJoin('detalle_etapas','etapas_ots.detalle_etapa','=','detalle_etapas.id')
        ->where('etapas_ots.id_procesos','=',$id)
        ->get();

        return $e;
    }
    public function show($id)
    {
        $e=EtapasOts::where('id_procesos',$id)->where('estado','=',0)->get();

        return $e;
    }
    public function show2($id)
    {
        $e=EtapasOts::select('etapas.nombre',
            'detalle_etapas.id',
            'detalle_etapas.nombre AS nombre_detalle',
            'etapas_ots.fecha_inicio',
            'etapas_ots.fecha_termino',            
            'etapas_ots.oc')->join('etapas','etapas_ots.etapa','=','etapas.id')->join('detalle_etapas','etapas_ots.detalle_etapa','=','detalle_etapas.id')->where('etapas_ots.estado',0)->where('etapas_ots.oc','=',$id)->get();

        return $e;
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
     public function update3(Request $request)
    {
        $e=EtapasOts::where('id',$request->id)->update($request->except('_method', '_token'));
    }
    public function update(Request $request, $id)
    {
        $e=EtapasOts::where('oc',$id)->where('etapa','=',$request->etapa)->update($request->except('_method', '_token'));
    }

     public function update2(Request $request)
    {
        $e=EtapasOts::where('id_procesos',$request->id)->update(['estado'=>$request->estado]);
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
