<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convenioscpp;

class ConvenioscppController extends Controller
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
        $r=new Convenioscpp();
        $r->nombre=$request->nombre;
        $r->fecha_i=$request->fechai;
        $r->fecha_t=$request->fechat;
        $r->id_cpp=$request->cpp;
        $r->monto=$request->monto;
        $r->nuevo=$request->nuevo;
        $r->id_convenio=$request->id_convenio;
        $r->programa=$request->programa;
        $r->estado=$request->estado;
        $r->usuario=$request->usuario;
        $r->cc=$request->cc;
        $r->proveedor=$request->proveedor;
        $r->save();

        return $r->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show3($id)
    {
        $c=Convenioscpp::select('gestion_ordenes.convenios.id',
            'gestion_ordenes.convenios.nombre',
            'gestion_ordenes.convenios.fecha_i',
            'gestion_ordenes.convenios.fecha_t',
            'gestion_ordenes.convenios.id_cpp',
            'gestion_ordenes.convenios.monto',
            'gestion_ordenes.convenios.nuevo',
            'gestion_ordenes.convenios.id_convenio',
            'gestion_ordenes.convenios.estado',
            'gestion_ordenes.convenios.programa',
            'gestion_ordenes.convenios.created_at',
            'gestion_ordenes.convenios.cc',
            'gestion_ordenes.convenios.proveedor',
            'gestion_ordenes.convenios.updated_at',
            'gestion_ordenes.convenios.usuario',
            'prespuestos.centrosdecostos.nombre as nombre_cc',
            'gestion_ordenes.proveedores.nombre as nombre_provedor',
             'gestion_ordenes.compromisos.numero',
             'gestion_ordenes.estado_convenio.nombre AS estado_convenio')
        ->join('prespuestos.centrosdecostos','gestion_ordenes.convenios.cc','=','prespuestos.centrosdecostos.id')
        ->join('gestion_ordenes.proveedores','gestion_ordenes.convenios.proveedor','=','gestion_ordenes.proveedores.id')
        ->join('gestion_ordenes.estado_convenio','gestion_ordenes.estado_convenio.id','=','gestion_ordenes.convenios.estado')
        ->leftjoin('gestion_ordenes.compromisos','gestion_ordenes.convenios.id_cpp','=','gestion_ordenes.compromisos.id')
        ->where('gestion_ordenes.convenios.usuario',$id)
        ->where('gestion_ordenes.convenios.nuevo','!=',0)
        ->orderby('gestion_ordenes.convenios.id','DESC')
        ->get();
        return $c;
    }
    public function show($id)
    {
        $c=Convenioscpp::find($id);
        return $c;
    }
    public function show2($id)
    {
        $c=Convenioscpp::where('id_convenio',$id)->where('estado',"=",0)->where('nuevo','!=',1)->get();
        return $c;
    }
     public function show4($id)
    {
        $c=Convenioscpp::where('id_cpp',$id)->get();
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
       Convenioscpp::find($id)->update($request->except('_method', '_token'));
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
