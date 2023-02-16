<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compromisos;
use App\CPPHistorialObservaciones;


class CompromisosController extends Controller
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
    public function store3(Request $request)
    {
     $u=Compromisos::where('year',$request->year)->where('year',$request->year)->sum('total');
     return $u;
   }

   public function store4(Request $request)
   {
    $sql=DB::table('gestion_ordenes')
    ->select('gestion_ordenes.compromisos.numero', 'gestion_ordenes.compromisos.year', 'gestion_ordenes.compra.compra_numero', 'gestion_ordenes.compra.compra_amio', 'gestion_ordenes.producto_compra.pro_cc', 'prespuestos.centrosdecostos.nombre as cc', 'prespuestos.centro_de_responsabilidad.nombre as cr', 'gestion_ordenes.estado_cpp.nombre as estado', 'ssalud.persona.per_nombre as nombre', 'gestion_ordenes.cpp_historial_observaciones.observacion', 'gestion_ordenes.compromisos.id_observacion', 'gestion_ordenes.compromisos.usuario', 'bodega_inventario.recepcion_bodega.num_recepcion', 'gestion_ordenes.proveedores.id as id_proveedor', 'gestion_ordenes.proveedores.run as run_proveedor', 'gestion_ordenes.proveedores.nombre as nombre_proveedor', 'gestion_ordenes.compromisos.total')
    ->join('gestion_ordenes','gestion_ordenes.producto_compra.pro_id_cpp','=','gestion_ordenes.compromisos.id')
    ->leftJoin('gestion_ordenes','gestion_ordenes.producto_compra.pro_id_oc','=','gestion_ordenes.compra.compra_id')
    ->join('prespuestos','gestion_ordenes.producto_compra.pro_cc','=','prespuestos.centrosdecostos.id')
    ->join('prespuestos','prespuestos.centrosdecostos.cr','=','prespuestos.centro_de_responsabilidad.id')
    ->join('gestion_ordenes','gestion_ordenes.compromisos.estado','=','gestion_ordenes.estado_cpp.id')
    ->join('ssalud','gestion_ordenes.compromisos.usuario','=','ssalud.persona.per_rut')
    ->join('gestion_ordenes','gestion_ordenes.compromisos.id_observacion','=','gestion_ordenes.cpp_historial_observaciones.id')
    ->leftJoin('bodega_inventario','bodega_inventario.recepcion_bodega.id_cpp','=','gestion_ordenes.compromisos.id')
    ->join('gestion_ordenes','gestion_ordenes.compromisos.id_proveedor','=','gestion_ordenes.proveedores.id')
    ->where('gestion_ordenes.compromisos.year','=',2022)
    ->where('gestion_ordenes.compromisos.numero','=',1)
    ->orWhere('gestion_ordenes.proveedores.id','=','')
    ->where('gestion_ordenes.estado_cpp.id','=',3)
    ->orWhere('gestion_ordenes.compra.compra_numero','=','')
    ->where('gestion_ordenes.compra.compra_amio','=','')
    ->where('gestion_ordenes.compromisos.usuario','=','16769415-2')
    ->groupBy('gestion_ordenes.compromisos.id')
    ->get();

    return $sql;
  }
public function store7(Request $request)
  {
   $u=Compromisos::select('compromisos.id',
    'compromisos.numero',
    'compromisos.year',
    'compromisos.oc',
    'compromisos.id_observacion',
    'compromisos.total_neto',
    'compromisos.iva',
    'compromisos.bruto',
    'compromisos.total',
    'compromisos.descuento',
    'compromisos.despacho',
    'compromisos.impuesto',
    'compromisos.tipo',
    'compromisos.id_convenios',
    'compromisos.id_proveedor',
    'compromisos.id_migracion_cpp',
    'compromisos.tipo_cpp',
    'compromisos.usuario',
    'compromisos.id_factura',
    'compromisos.created_at',
    'compromisos.id_comprador',
    'compromisos.ajustes',
    'compromisos.updated_at',
    'compromisos.id_licitacion',
    'compromisos.ocportal',
    'compromisos.id_f_quimico',
    'estado_cpp.id as cpp_estado_id',
    'estado_cpp.nombre as cpp_estado',
    'refrendacion.id as id_refrendacion',
    'licitacion.nombre as nombre_licitacion',
    'convenios.id as convenio_id','convenios.nombre','convenios.fecha_i','convenios.fecha_t','convenios.nuevo','convenios.id_convenio','convenios.estado as estado_conv')
   ->leftjoin('encargado_quimicos','encargado_quimicos.id','=','compromisos.id_f_quimico')
   ->leftjoin('refrendacion','refrendacion.id_compromiso','=','compromisos.id')
   ->join('estado_cpp','compromisos.estado','=','estado_cpp.id')
   ->leftjoin('licitacion','compromisos.id_licitacion','=','licitacion.id')
   ->leftjoin('convenios','compromisos.id_convenios','=','convenios.id')
   
   ->where('compromisos.numero',$request->numero)
   ->where('compromisos.year','=',$request->year)
   ->get();
   
   return $u;
 }
  public function store2(Request $request)
  {
   $u=Compromisos::select('compromisos.id',
    'compromisos.numero',
    'compromisos.year',
    'compromisos.oc',
    'compromisos.id_observacion',
    'compromisos.total_neto',
    'compromisos.iva',
    'compromisos.bruto',
    'compromisos.total',
    'compromisos.descuento',
    'compromisos.despacho',
    'compromisos.impuesto',
    'compromisos.tipo',
    'compromisos.id_convenios',
    'compromisos.id_proveedor',
    'compromisos.id_migracion_cpp',
    'compromisos.tipo_cpp',
    'compromisos.usuario',
    'compromisos.id_factura',
    'compromisos.created_at',
    'compromisos.id_comprador',
    'compromisos.ajustes',
    'compromisos.updated_at',
    'compromisos.id_licitacion',
    'compromisos.ocportal',
    'compromisos.id_f_quimico',
    'estado_cpp.id as cpp_estado_id',
    'estado_cpp.nombre as cpp_estado',
    'refrendacion.id as id_refrendacion',
    'licitacion.nombre as nombre_licitacion',
    'convenios.id as convenio_id','convenios.nombre','convenios.fecha_i','convenios.fecha_t','convenios.nuevo','convenios.id_convenio','convenios.estado as estado_conv')
   ->leftjoin('encargado_quimicos','encargado_quimicos.id','=','compromisos.id_f_quimico')
   ->leftjoin('refrendacion','refrendacion.id_compromiso','=','compromisos.id')
   ->join('estado_cpp','compromisos.estado','=','estado_cpp.id')
   ->leftjoin('licitacion','compromisos.id_licitacion','=','licitacion.id')
   ->leftjoin('convenios','compromisos.id_convenios','=','convenios.id')
   
   ->where('compromisos.numero',$request->numero)
   ->where('compromisos.year','=',$request->year)
   ->first();
   
   return $u;
 }
 public function store(Request $request)
 {
  $u=Compromisos::where('year',$request->year)->get()->last();


  if(is_null($u)){
    $numero=1;
  }else{
    $numero=$u->numero+1;
  }




  $c=new Compromisos();
  $c->numero=$numero;
  $c->year=$request->year;
  $c->oc=$request->oc;
  $c->estado=1;       
  $c->total_neto=$request->total_neto;
  $c->iva=$request->iva;
  $c->total=$request->total;
  $c->descuento=$request->descuento;
  $c->despacho=$request->despacho;
  $c->impuesto=$request->impuesto;
  $c->id_proveedor=$request->proveedor;
  $c->usuario=$request->usuario;
  $c->tipo=$request->tipo;   
  $c->id_comprador=$request->id_comprador;    
  $c->save();

  $o=new CPPHistorialObservaciones();
  $o->cpp=$c->id;
  $o->observacion=$request->observacion;
  $o->usuario=$request->usuario;
  $o->estado=1;
  $o->save();

  $cpp=Compromisos::find($c->id)->update(['id_observacion'=>$o->id]);

  return $c->id;

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
      $c=Compromisos::select('compromisos.id',
    'compromisos.numero',
    'compromisos.year',
    'compromisos.oc',
    'compromisos.id_observacion',
    'compromisos.total_neto',
    'compromisos.iva',
    'compromisos.bruto',
    'compromisos.total',
    'compromisos.descuento',
    'compromisos.despacho',
    'compromisos.impuesto',
    'compromisos.tipo',
    'compromisos.id_convenios',
    'compromisos.id_proveedor',
    'compromisos.id_migracion_cpp',
    'compromisos.tipo_cpp',
    'compromisos.usuario',
    'compromisos.id_factura',
    'compromisos.created_at',
    'compromisos.id_comprador',
    'compromisos.ajustes',
    'compromisos.updated_at',
    'compromisos.id_licitacion',
    'compromisos.ocportal',
    'estado_cpp.id as cpp_estado_id',
    'estado_cpp.nombre as cpp_estado',
    'refrendacion.id as id_refrendacion',
    'licitacion.nombre as nombre_licitacion',
    'licitacion.fecha',
    'cpp_historial_observaciones.observacion',
     'tipo_cpp.nombre as tiponombre')
   ->join('tipo_cpp','compromisos.tipo','=','tipo_cpp.id')
   ->join('cpp_historial_observaciones','compromisos.id','=','cpp_historial_observaciones.cpp')
   ->leftjoin('refrendacion','refrendacion.id_compromiso','=','compromisos.id')
   ->join('estado_cpp','compromisos.estado','=','estado_cpp.id')
   ->leftjoin('licitacion','compromisos.id_licitacion','=','licitacion.id')
   ->where('compromisos.id',$id) 
   ->first();
      return $c;
    }

    public function show2($id)
    {
      $c=Compromisos::select('refrendacion.fecha_encargado',
        'refrendacion.encargado',
        'refrendacion.jefatura',
        'refrendacion.fecha_jefatura',
        'refrendacion.year',
        'compromisos.numero',
        'refrendacion.envio',
        'refrendacion.fecha_envio','compromisos.id')    
      ->leftjoin('refrendacion','compromisos.id','=','refrendacion.id_compromiso')
      ->where('compromisos.id','=',$id)
      ->first();
      return $c;
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

     $cpp=Compromisos::find(intval($id))->update($request->except('_method', '_token'));

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
