<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bodega;

class BodegaController extends Controller
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
     public function store2(Request $request)
    {
        $b=new Bodega();
        $b->tipo_bodega=$request->tipo;
        $b->cod_producto=$request->codigo;
        $b->stock_producto=$request->stock;       
        $b->unidad_medida='UD';
        $b->save();
        $bo=Bodega::find($b->id);
        return $bo;

    }    
    public function store(Request $request)
    {
       $b=Bodega::where('tipo_bodega',$request->tipo)
       ->where('cod_producto','=',$request->codigo)
       ->whereNull('id_programa_assoc')->get();
       return $b; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
        Bodega::find($id)->update($request->except('_method', '_token'));
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
