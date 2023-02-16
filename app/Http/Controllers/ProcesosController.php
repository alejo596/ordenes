<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procesos;
use App\Productos;
use Illuminate\Support\Facades\DB;
use DateTime;
use DatePeriod;
use DateInterval;


class ProcesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $p=Procesos::all();
      return $p;
  }

public function daysWeek(Request $request){


    $datestart= strtotime(date($request->inicio));
    $datesuma = 15 * 86400;
    $diasemana = date('N',$datestart);
    $totaldias = $diasemana+$request->dias;
    $findesemana = intval( $totaldias/5) *2 ; 
    $diasabado = $totaldias % 5 ; 
    if ($diasabado==6) $findesemana++;
    if ($diasabado==0) $findesemana=$findesemana-2;
 
    $total = (($request->dias+$findesemana) * 86400)+$datestart ; 
    return $fechafinal = date('Y-m-d', $total);
}

    



public function index2()
{
    $procesos=DB::table('procesos')
    ->select('procesos.etapa', 'procesos.id as id_proceso', 'procesos.id_comprador', 'procesos.estado', 'procesos.id_licitacion', 'procesos.year', 'procesos.observacion', 'procesos.created_at', 'procesos.updated_at', 'funcionarios_compra.per_nombre as comprador', 'estado_proceso_compra.nombre','licitacion.nombre as nombre_licitacion','producto_compra.pro_id','compra.compra_numero','compra.compra_id')
    ->join('funcionarios_compra','procesos.id_comprador','=','funcionarios_compra.id')
    ->join('estado_proceso_compra','procesos.estado','=','estado_proceso_compra.id')
    ->join('etapas_ots','procesos.id','=','etapas_ots.id_procesos')    
    ->leftjoin('licitacion','procesos.id_licitacion','=','licitacion.id')
    ->join('producto_compra','procesos.id','=','producto_compra.id_proceso')
    ->join('compra','producto_compra.pro_id_oc','=','compra.compra_id')
    ->groupBy('procesos.id')
    ->get();

    return $procesos;
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
        $p=new Procesos();       
        $p->estado=$request->estado;
        $p->id_comprador=$request->id_comprador;
        $p->etapa=$request->etapa;
        $p->year=$request->year;
        $p->save();

        //$producto=Productos::where('pro_id',$request->id_producto)->update(['id_proceso'=>$p->id]);

        return $p->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show5($id)
    {
      $c=Procesos::select('procesos.id',
        'procesos.etapa',
        'procesos.id_comprador',
        'procesos.estado',
        'procesos.id_licitacion',
        'procesos.year',
        'procesos.observacion',
        'procesos.created_at',
        'procesos.updated_at',
        'producto_compra.pro_id_cpp',
        'refrendacion.fecha_envio',
        'refrendacion.envio',
        'refrendacion.encargado',
        'refrendacion.fecha_encargado',
        'refrendacion.jefatura',
        'refrendacion.fecha_jefatura')
      ->leftjoin('producto_compra' ,'procesos.id','=','producto_compra.id_proceso')
      ->leftjoin('refrendacion','producto_compra.pro_id_cpp','=','refrendacion.id_compromiso')     
      ->where('procesos.id','=',$id)  
      ->first();
      return $c;

  }
  public function show4($id)
  {
      $c=Procesos::select('etapas_ots.proceso','etapas_ots.id')
      ->join('etapas_ots','procesos.id','=','etapas_ots.id_procesos')     
      ->where('procesos.id','=',$id)
      ->orderBy('etapas_ots.id','DESC')
      ->limit(1)
      ->first();
      return $c;

  }
  public function show3($id)
  {
      $c=Procesos::select('detalle_etapas.id',
        'procesos.etapa',
        'procesos.id_comprador',
        'procesos.estado',
        'procesos.id_licitacion',
        'procesos.year',
        'procesos.observacion',
        'procesos.created_at',
        'procesos.updated_at',
        'detalle_etapas.nombre',
        'detalle_etapas.verificar',
        'funcionarios_compra.per_id',
        'detalle_etapas.dias')
      ->join('detalle_etapas','procesos.etapa','=','detalle_etapas.id_etapa')
      ->join('funcionarios_compra','procesos.id_comprador','=','funcionarios_compra.id')
      ->where('detalle_etapas.verificar',1)
      ->where('procesos.id','=',$id)
      ->first();

      return $c;

  }
  public function show2($id)
  {
    $c=Procesos::select('procesos.id',
        'procesos.etapa',
        'procesos.id_comprador',
        'procesos.estado',
        'procesos.id_licitacion',
        'procesos.year',
        'procesos.observacion',
        'procesos.created_at',
        'procesos.updated_at',
        'estado_proceso_compra.nombre')
    ->where('procesos.id',$id)
    ->join('estado_proceso_compra','procesos.estado','=','estado_proceso_compra.id')
    ->first();

    return $c;
}  
public function show($id)
{
    $procesos=DB::table('procesos')->select('procesos.id',
        'procesos.etapa',
        'procesos.id_comprador',
        'procesos.estado',
        'procesos.year',
        'procesos.observacion',
        'procesos.id_licitacion',
        'procesos.created_at',
        'procesos.updated_at',
        'producto_compra.id_proceso',
        'compra.compra_numero',
        'compra.compra_id',
        'compra.id_historial',
        'compra.compra_fecha_anulacion',
        'licitacion.nombre',
        'licitacion.fecha',
        'licitacion.fecha_termino',
        'estado_licitacion.nombre as nombre_estado_licitacion',
        DB::raw('COUNT(producto_compra.pro_id)  as cantidad'))
    ->join('producto_compra','procesos.id','=','producto_compra.id_proceso')
    ->join('compra','producto_compra.pro_id_oc','=','compra.compra_id')
    ->leftjoin('licitacion','procesos.id_licitacion','=','licitacion.id')
    ->leftjoin('estado_licitacion','licitacion.codigo','=','estado_licitacion.codigos')
    ->where('id_comprador',$id)  
    ->whereNotIn('procesos.estado',[5,3])
    ->groupBy('procesos.id')     
    ->get();

    return $procesos;
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
    public function update2(Request $request)
    {
        $p=Procesos::where('id',$request->id)->update($request->except('_method', '_token'));
        return $request->id;
    }
    public function update(Request $request, $id)
    {
        $p=Procesos::where('id_producto',$id)->update($request->except('_method', '_token'));
        return $id;
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
