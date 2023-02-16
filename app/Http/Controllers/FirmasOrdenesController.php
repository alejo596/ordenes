<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirmasOrdenes;
use Illuminate\Support\Facades\DB;

class FirmasOrdenesController extends Controller
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
        $orden=new FirmasOrdenes();
        $orden->rut_aprobar=$request->run;
        $orden->nombre_aprobar=$request->nombre;
        $orden->cc_asociado_aprobar=$request->cc_asociado;
        $orden->aprobado=$request->aprobar;
        $orden->fecha_de_aprobado_o_rechazado=$request->fecha;
        $orden->id_ot=$request->oc;
        $orden->save();
        return $orden->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)// centro de costo
    {
        $order=DB::connection('ordenes_de_compras')
        ->select('SELECT
            gestion_ordenes.solicitudes.id_doc,
            gestion_ordenes.firmas_solicitudes.usuario,
            gestion_ordenes.estado_solicitudes.nombre,
            ssalud.persona.per_nombre,
            gestion_ordenes.firmas_solicitudes.created_at
            FROM
            gestion_ordenes.firmas_solicitudes
            INNER JOIN gestion_ordenes.solicitudes ON gestion_ordenes.solicitudes.id = gestion_ordenes.firmas_solicitudes.id_solicitud
            INNER JOIN gestion_ordenes.estado_solicitudes ON gestion_ordenes.solicitudes.estado = gestion_ordenes.estado_solicitudes.id
            INNER JOIN ssalud.persona ON gestion_ordenes.firmas_solicitudes.usuario = ssalud.persona.per_rut COLLATE utf8_general_ci
            where estado_solicitudes.id=9 and solicitudes.id_doc='.$id);
        return $order;
    }
     public function showsub($id)//subdirecciom
     {
        $order=DB::connection('ordenes_de_compras')
        ->select('SELECT
            gestion_ordenes.solicitudes.id_doc,
            gestion_ordenes.firmas_solicitudes.usuario,
            gestion_ordenes.estado_solicitudes.nombre,
            ssalud.persona.per_nombre,
            gestion_ordenes.firmas_solicitudes.created_at
            FROM
            gestion_ordenes.firmas_solicitudes
            INNER JOIN gestion_ordenes.solicitudes ON gestion_ordenes.solicitudes.id = gestion_ordenes.firmas_solicitudes.id_solicitud
            INNER JOIN gestion_ordenes.estado_solicitudes ON gestion_ordenes.solicitudes.estado = gestion_ordenes.estado_solicitudes.id
            INNER JOIN ssalud.persona ON gestion_ordenes.firmas_solicitudes.usuario = ssalud.persona.per_rut COLLATE utf8_general_ci
            where estado_solicitudes.id=11 and solicitudes.id_doc='.$id);
        return $order;
    }

    public function showter($id)//terceros
     {
        $order=DB::connection('ordenes_de_compras')
        ->select('SELECT
            gestion_ordenes.solicitudes.id_doc,
            gestion_ordenes.firmas_solicitudes.usuario,
            gestion_ordenes.estado_solicitudes.nombre,
            ssalud.persona.per_nombre,
            gestion_ordenes.firmas_solicitudes.created_at
            FROM
            gestion_ordenes.firmas_solicitudes
            INNER JOIN gestion_ordenes.solicitudes ON gestion_ordenes.solicitudes.id = gestion_ordenes.firmas_solicitudes.id_solicitud
            INNER JOIN gestion_ordenes.estado_solicitudes ON gestion_ordenes.solicitudes.estado = gestion_ordenes.estado_solicitudes.id
            INNER JOIN ssalud.persona ON gestion_ordenes.firmas_solicitudes.usuario = ssalud.persona.per_rut COLLATE utf8_general_ci
            where estado_solicitudes.id=8 and solicitudes.id_doc='.$id);
        return $order;
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
