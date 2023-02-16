<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitudes;
use Illuminate\Support\Facades\DB;

class SolicitudesController extends Controller
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
    public function store5(Request $request)
    {

       $s=Solicitudes::select("solicitudes.id",
        "gestion_ordenes.solicitudes.tipo",
        "gestion_ordenes.solicitudes.estado",
        "gestion_ordenes.solicitudes.usuario",
        "gestion_ordenes.solicitudes.year",
        "gestion_ordenes.solicitudes.cc",
        "gestion_ordenes.solicitudes.id_doc",
        "gestion_ordenes.solicitudes.numero",
        "gestion_ordenes.solicitudes.prioridad",
        "gestion_ordenes.solicitudes.created_at",
        "gestion_ordenes.solicitudes.updated_at",
        "gestion_ordenes.solicitudes.observacion",
        "gestion_ordenes.solicitudes.activo",
        "gestion_ordenes.firmas_solicitudes.estado  as actividad",
        "gestion_ordenes.estado_solicitudes.nombre",
        "ssalud.persona.per_nombre")
       ->join('gestion_ordenes.firmas_solicitudes','gestion_ordenes.solicitudes.id','=','gestion_ordenes.firmas_solicitudes.id_solicitud')
       ->join('gestion_ordenes.estado_solicitudes','gestion_ordenes.solicitudes.estado','=','gestion_ordenes.estado_solicitudes.id')
       ->join('ssalud.persona','gestion_ordenes.firmas_solicitudes.usuario','=',DB::raw('ssalud.persona.per_rut COLLATE utf8_general_ci'))
       ->where('gestion_ordenes.solicitudes.id_doc',$request->id)
       ->where('gestion_ordenes.solicitudes.tipo','=',$request->tipo)
       ->get();

       return $s;



   }   
   public function store3(Request $request)
   {
     $s=Solicitudes::select('gestion_ordenes.solicitudes.tipo',
        'gestion_ordenes.solicitudes.id',
        'gestion_ordenes.solicitudes.estado',
        'gestion_ordenes.solicitudes.usuario',
        'gestion_ordenes.solicitudes.year as compra_amio',
        'gestion_ordenes.solicitudes.cc',
        'gestion_ordenes.solicitudes.id_doc', 
        'gestion_ordenes.solicitudes.numero as compra_numero',
        'gestion_ordenes.solicitudes.created_at',
        'gestion_ordenes.solicitudes.updated_at',
        'gestion_ordenes.solicitudes.anticipo',
         'gestion_ordenes.solicitudes.idproveedor',
        'gestion_ordenes.firmas_solicitudes.id as firmas_id',
        'prespuestos.centrosdecostos.cr',
        'prespuestos.centrosdecostos.nombre as cc_nombre',
        'gestion_ordenes.tipo_solicitudes.nombre AS fondo',
        'gestion_ordenes.estado_solicitudes.nombre AS estado_nombre',
        'gestion_ordenes.encargado_cr.rut_cr_encargado')
     ->leftjoin('gestion_ordenes.firmas_solicitudes','gestion_ordenes.solicitudes.id','=','gestion_ordenes.firmas_solicitudes.id_solicitud','and','gestion_ordenes.solicitudes.estado','=','gestion_ordenes.firmas_solicitudes.estado')
     ->join('prespuestos.centrosdecostos','gestion_ordenes.solicitudes.cc','=','prespuestos.centrosdecostos.id')
     ->join('gestion_ordenes.tipo_solicitudes','gestion_ordenes.solicitudes.tipo','=','gestion_ordenes.tipo_solicitudes.id')
     ->join('gestion_ordenes.estado_solicitudes','gestion_ordenes.solicitudes.estado','=','gestion_ordenes.estado_solicitudes.id')
     ->join('gestion_ordenes.encargado_cr','prespuestos.centrosdecostos.cr','=','gestion_ordenes.encargado_cr.id_cr')
     ->where('gestion_ordenes.encargado_cr.rut_cr_encargado',$request->run)
     ->where('gestion_ordenes.solicitudes.estado','=',$request->estado)
     ->where('gestion_ordenes.solicitudes.year','=',$request->year)
     ->where('gestion_ordenes.solicitudes.tipo','=',$request->tipo)
     ->get();
     return $s;
 }
 public function store4(Request $request)
 {
     $s=Solicitudes::select('gestion_ordenes.solicitudes.tipo',
        'gestion_ordenes.solicitudes.id',
        'gestion_ordenes.solicitudes.estado',
        'gestion_ordenes.solicitudes.usuario',
        'gestion_ordenes.solicitudes.year as compra_amio',
        'gestion_ordenes.solicitudes.cc',
        'gestion_ordenes.solicitudes.id_doc', 
        'gestion_ordenes.solicitudes.numero as compra_numero',
        'gestion_ordenes.solicitudes.prioridad',
        'gestion_ordenes.solicitudes.created_at',
        'gestion_ordenes.solicitudes.updated_at',
        'gestion_ordenes.firmas_solicitudes.id as firmas_id',
        'prespuestos.centrosdecostos.cr',
        'prespuestos.centrosdecostos.nombre as cc_nombre',
        'gestion_ordenes.tipo_solicitudes.nombre AS fondo',
        'gestion_ordenes.estado_solicitudes.nombre AS estado_nombre')
     ->leftjoin('gestion_ordenes.firmas_solicitudes',function($q) use ($request){ 
       $q->on('gestion_ordenes.solicitudes.id','=','gestion_ordenes.firmas_solicitudes.id_solicitud');

   })
     ->join('prespuestos.centrosdecostos','gestion_ordenes.solicitudes.cc','=','prespuestos.centrosdecostos.id')
     ->join('gestion_ordenes.tipo_solicitudes','gestion_ordenes.solicitudes.tipo','=','gestion_ordenes.tipo_solicitudes.id')
     ->join('gestion_ordenes.estado_solicitudes','gestion_ordenes.solicitudes.estado','=','gestion_ordenes.estado_solicitudes.id')

     ->where('gestion_ordenes.solicitudes.usuario',$request->run)
     ->where('gestion_ordenes.solicitudes.estado','=',$request->estado)
     ->where('gestion_ordenes.solicitudes.year','=',$request->year)
     ->where('gestion_ordenes.solicitudes.tipo','=',$request->tipo)  
     ->where('gestion_ordenes.solicitudes.activo','=',0)    
     ->get();
     return $s;
 }

 public function store2(Request $request)
 {
     $s=Solicitudes::select('gestion_ordenes.solicitudes.tipo',
        'gestion_ordenes.solicitudes.id',
        'gestion_ordenes.solicitudes.estado',
        'gestion_ordenes.solicitudes.usuario',
        'gestion_ordenes.solicitudes.year as compra_amio',
        'gestion_ordenes.solicitudes.cc',
        'gestion_ordenes.solicitudes.id_doc', 
        'gestion_ordenes.solicitudes.numero as compra_numero',
        'gestion_ordenes.solicitudes.prioridad',
        'gestion_ordenes.solicitudes.created_at',
        'gestion_ordenes.solicitudes.updated_at',
        'gestion_ordenes.firmas_solicitudes.id as firmas_id',
        'prespuestos.centrosdecostos.cr',
        'prespuestos.centrosdecostos.nombre as cc_nombre',
        'gestion_ordenes.tipo_solicitudes.nombre AS fondo',
        'gestion_ordenes.estado_solicitudes.nombre AS estado_nombre',
        'gestion_ordenes.encargados_cc.rut_encargado')
     ->leftjoin('gestion_ordenes.firmas_solicitudes',function($q) use ($request){ 
       $q->on('gestion_ordenes.solicitudes.id','=','gestion_ordenes.firmas_solicitudes.id_solicitud')
       ->where('gestion_ordenes.solicitudes.estado','=','gestion_ordenes.firmas_solicitudes.estado');
   })
     ->join('prespuestos.centrosdecostos','gestion_ordenes.solicitudes.cc','=','prespuestos.centrosdecostos.id')
     ->join('gestion_ordenes.tipo_solicitudes','gestion_ordenes.solicitudes.tipo','=','gestion_ordenes.tipo_solicitudes.id')
     ->join('gestion_ordenes.estado_solicitudes','gestion_ordenes.solicitudes.estado','=','gestion_ordenes.estado_solicitudes.id')
     ->join('gestion_ordenes.encargados_cc','prespuestos.centrosdecostos.id','=','gestion_ordenes.encargados_cc.id_cc')
     ->where('gestion_ordenes.encargados_cc.rut_encargado',$request->run)
     ->where('gestion_ordenes.solicitudes.estado','=',$request->estado)
     ->where('gestion_ordenes.solicitudes.year','=',$request->year)
     ->where('gestion_ordenes.solicitudes.tipo','=',$request->tipo)    
     ->where('gestion_ordenes.solicitudes.activo','=',0)  
     ->get();

     
     return $s;
 }
 public function store(Request $request)
 {
    $c=new Solicitudes();
    $c->tipo=$request->tipo;
    $c->estado=$request->estado;
    $c->usuario=$request->usuario;
    $c->year=$request->year;
    $c->cc=$request->cc;
    $c->numero=$request->numero;
    $c->id_doc=$request->id_doc;
    $c->prioridad=$request->prioridad;
    $c->activo=$request->activo;
    $c->save();

    return $c->id;
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show3($id)
    {

      $s=Solicitudes::where('id_doc',$id)->get();
      return  $s;
    }
    public function show($id)
    {
       $s=Solicitudes::where('id_doc',$id)
       ->where('activo','=',0)
       ->where('estado','=',2)
       ->where('prioridad',1)
       ->where('tipo',5)
       ->count();
       return  $s;
   }
   public function show2($id){
    $s=Solicitudes::select(
        DB::raw('0 as crud'),
        'gestion_ordenes.solicitudes.id',
        'gestion_ordenes.solicitudes.tipo',
        'gestion_ordenes.solicitudes.estado',
        'gestion_ordenes.solicitudes.usuario',
        'gestion_ordenes.solicitudes.year',
        'gestion_ordenes.solicitudes.cc',
        'gestion_ordenes.solicitudes.id_doc',
        'gestion_ordenes.solicitudes.numero',
        'gestion_ordenes.solicitudes.prioridad',
        'gestion_ordenes.solicitudes.created_at',
        'gestion_ordenes.solicitudes.updated_at',
        'gestion_ordenes.solicitudes.observacion',
        'gestion_ordenes.solicitudes.activo',
        'ssalud.persona.per_nombre')
    ->join('ssalud.persona','gestion_ordenes.solicitudes.usuario','=',DB::raw('ssalud.persona.per_rut COLLATE utf8_general_ci'))
    ->where('solicitudes.id_doc',$id)
    ->where('solicitudes.activo','=',3)
    ->where('solicitudes.estado','=',2)
    ->where('solicitudes.tipo',5)
    ->get();

    return $s;

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
        Solicitudes::find($id)->update($request->except('_method', '_token'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Solicitudes::find($id)->delete();
    }
}
