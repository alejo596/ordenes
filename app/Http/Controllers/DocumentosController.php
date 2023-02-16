<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documentos;
class DocumentosController extends Controller
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

        $f=Documentos::where('numero',$request->numero)->where('proveedor_rut',$request->run)->where('docto_estado_id',1)->first();   

       if(is_null($f)){
        $d= new Documentos();
        $d->numero=$request->numero;
        $d->monto=$request->monto;
        $d->fecha_factura=$request->fechae;
        $d->fecha_recepcion=$request->fechar;
        $d->proveedor_rut=$request->run;
        $d->docto_tipo_id=$request->tipo;
        $d->docto_estado_id=1;
        $d->docto_sistema_id=1;
        $d->nuevocpp=2;
        $d->save();

        return $d->id;

       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
