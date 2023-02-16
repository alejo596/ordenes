<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistorialdeCompras;

class HistorialdeComprasController extends Controller
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
        $h=new HistorialdeCompras();
        $h->id_compra=$request->id_compra;
        $h->actividad=$request->actividad;
        $h->estado=$request->estado;
        $h->usuario=$request->usuario;
        $h->save();
        return $h->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $h=HistorialdeCompras::select('historia_de_compra.id',
            'historia_de_compra.id_compra',
            'historia_de_compra.actividad',
            'historia_de_compra.estado',
            'historia_de_compra.created_at',
            'historia_de_compra.updated_at',
            'historia_de_compra.usuario',
            'actividad_estados.nombre')
        ->leftjoin('actividad_estados','historia_de_compra.actividad','=','actividad_estados.id')
        ->where('id_compra',$id)->get();
        return $h;
    }
     public function show2($id)
    {
        $h=HistorialdeCompras::select('historia_de_compra.id',
            'historia_de_compra.id_compra',
            'historia_de_compra.actividad',
            'historia_de_compra.estado',
            'historia_de_compra.created_at',
            'historia_de_compra.updated_at',
            'historia_de_compra.usuario',
            'actividad_estados.nombre')
        ->leftjoin('actividad_estados','historia_de_compra.actividad','=','actividad_estados.id')
        ->where('id_compra',$id)->get();
        return $h;
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
        $h=HistorialdeCompras::where('id_compra',$id)->where('estado','=',5)->update($request->except('_method', '_token'));
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
