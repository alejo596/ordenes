<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Productos_Base;

use App\Year;
use App\Refrendacio_envios;
use Illuminate\Support\Facades\DB;

class CrearProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p=Productos_Base::all();
        return $p;

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
        $year=Year::where('estado',1)->first();


        if($request->sub_item_sigfe =='null'){
            $request->sub_item_sigfe=NULL;
        }    
        $p=new Productos();       
        $p->pro_id_oc=$request->oc;
        $p->pro_nombre=$request->nombre;
        $p->pro_cantidad=$request->cantidad;
        $p->pro_descripcion=$request->detalle;
        $p->pro_precio=$request->precio;
        $p->pro_id_aba=$request->id_pro;     
        $p->pro_ordenados_por_numero=$request->orden; 
        $p->pro_cuenta_sigfe=$request->cuenta;
        $p->pro_total=$request->total;
        $p->pro_uindad_medida=$request->unidad;
        $p->pro_nombre_sigfe=$request->nombre_sigfe;
        $p->pro_nombre_producto=$request->nombre_producto;
        $p->pro_sub_item_sigfe=$request->sub_item_sigfe;
        $p->pro_estado_producto=$request->estado;
        $p->pro_justificacion=$request->justificacion;
        $p->pro_cc=$request->cc;       
        $p->pro_amio=$year->year;
        $p->pro_convenio=$request->convenio;
        $p->pro_cantidad_solicitud=$request->cantidad; 
        $p->pro_costo_unitario_incluye_todo=$request->precio_todo;
        $p->pro_id_cpp=$request->pro_id_cpp;
        $p->pro_precio_unitario=$request->pro_precio_unitario;
        $p->pro_cantidad_unitario=$request->pro_cantidad_unitario;
        $p->sigfe_item=$request->sigfe_item;
        $p->pro_ID_ZGEN=$request->zgen;
        $p->save(); 
        return $p->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos=Productos_Base::where('codigo','like','%'.$id.'%')->OrWhere('nombre','like','%'.$id.'%')->get();
      return $productos;
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
