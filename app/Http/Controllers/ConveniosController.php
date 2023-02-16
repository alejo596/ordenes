<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convenios;
use Illuminate\Support\Facades\DB;

class ConveniosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        $c=new Convenios();
        $c->cont_estado=1;
        $c->cont_rut=$request->proveedor;
        $c->cont_nombre_empresa=$request->nombre_proveedor;
        $c->cont_nombre=$request->nombre;
        $c->cont_n_licitacion=$request->licitacion;       
        $c->cont_monto_inicial=$request->montoi;
        $c->cont_monto_actual=$request->actual;
        $c->cont_fecha_inicio=$request->fechai;
        $c->cont_fecha_termino=$request->fechat;
        $c->cont_u_responsable=$request->responsable;
        $c->cont_cc=$request->cc;
        $c->cont_rut_quien_crea_convenio=$request->usuario;
        $c->cont_nombre_abreviado=$request->nombre;
        $c->idcpp=$request->cpp;
        $c->year=$request->year;
        $c->save();

        return $c->id;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $c=Convenios::where('cont_id',$id)->first();
        return $c;


    }
    public function show($id)
    {
        $c=DB::connection('convenios')
        ->select('SELECT
            contratos.*, (
            SELECT

            IF (COUNT(*) > 0, "true", "false") AS CUANTOS
            FROM
            empresa_adicional
            WHERE
            emp_add_id_contrato = contratos.cont_id
            ) AS tiene_proveedores
            FROM
            contratos
            WHERE
            cont_estado = 1 and cont_nombre_abreviado LIKE "%'.$id.'%"');
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
