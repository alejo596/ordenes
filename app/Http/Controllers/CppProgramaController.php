<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CppPrograma;
use App\ConveniosProgramas;
class CppProgramaController extends Controller
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
       $p= new CppPrograma();
       $p->cpp=$request->cpp;
       $p->programa=$request->programa;
       $p->monto=$request->monto;
       $p->save();   
       return $p->id;
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
      $p=CppPrograma::select('cpp_programa.id',
        'cpp_programa.cpp',
        'cpp_programa.programa',
        'cpp_programa.monto',
        'cpp_programa.created_at',
        'cpp_programa.updated_at',
        'convenios_programas.destino',
        'convenios_programas.monto')
      ->join('convenios_programas','cpp_programa.programa','=','convenios_programas.id')
      ->where('cpp_programa.cpp',$id)
      ->first();
      return $p;
  }
   public function show3($id)
  {
    $p=ConveniosProgramas::where('convenios_programas.convenio_id','=',$id)
    ->sum('convenios_programas.monto');

    return $p;
}
  public function show($id)
  {
    $p=CppPrograma::select('cpp_programa.id',
        'cpp_programa.programa',
        'cpp_programa.monto',
        'cpp_programa.created_at',
        'cpp_programa.updated_at',
        'compromisos.numero',
        'cpp_programa.cpp',
        'compromisos.estado')
    ->join('gestion_ordenes.compromisos','cpp_programa.cpp','=','gestion_ordenes.compromisos.id')
    ->where('cpp_programa.programa',$id)
    ->where('compromisos.estado','=',3)
    ->get();

    return $p;
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
