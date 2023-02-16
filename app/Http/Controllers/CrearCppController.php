<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compromisos;
use App\CPPHistorialObservaciones;

class CrearCppController extends Controller
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
        $c->estado=$request->estado;       
        $c->total_neto=$request->total_neto;
        $c->iva=$request->iva;
        $c->total=$request->total;
        $c->descuento=$request->descuento;
        $c->despacho=$request->despacho;
        $c->impuesto=$request->impuesto;
        $c->id_proveedor=$request->proveedor;
        $c->usuario=$request->usuario;
        $c->tipo=$request->tipo;   
        $c->ajustes=$request->ajustes;   
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
        $c=Compromisos::find($id);
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
