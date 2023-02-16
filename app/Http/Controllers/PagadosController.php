<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagados;

class PagadosController extends Controller
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
        $p=new Pagados();
        $p->id_compromiso=$request->cpp;
        $p->year=$request->year;
        $p->monto=$request->monto;
        $p->ot=$request->ot;
        $p->estado=$request->estado;
        $p->cc=$request->cc;
        $p->sigfe=$request->sigfe;
        $p->save();

        return $p->id;
    }
    public function store(Request $request)
    {
        $p=Pagados::where('year',$request->year)
        ->where('cc','=',$request->cc)
        ->where('estado','=',13)
        ->where('sigfe','=',$request->sigfe)
        ->sum('monto');
        return $p;

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
