<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\encargado_cc;
use App\Centros;
use Illuminate\Support\Facades\DB;

class Jefaturas_centrosController extends Controller
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

        $encargado_cc= DB::connection('ordenes_de_compras')->select('SELECT
            gestion_ordenes.compra.id_historial,
            gestion_ordenes.compra.sigfe_presupuesto,
            gestion_ordenes.encargados_cc.id_cc,
            gestion_ordenes.compra.compra_numero,
            gestion_ordenes.compra.compra_amio,
            gestion_ordenes.compra.compra_nombre_usuario_rut,
            ssalud.persona.per_nombre,
            gestion_ordenes.compra.compra_telefono,
            gestion_ordenes.compra.compra_fecha_guardada,
            gestion_ordenes.compra.compra_id,
            gestion_ordenes.compra.compra_cc,
            gestion_ordenes.compra.compra_sub_direccion,
            gestion_ordenes.compra.compra_jefatura_sub_rut,
            gestion_ordenes.compra.compra_jefatura_sub_aprueba_fecha,
            gestion_ordenes.compra.compra_encargado_cc_rut,
            gestion_ordenes.compra.compra_encargado_cc_aprueba_fecha,
            gestion_ordenes.compra.compra_rut_guardada,
            gestion_ordenes.compra.compra_fecha_enviar,
            gestion_ordenes.compra.compra_rut_enviar,
            gestion_ordenes.compra.compra_asignada,
            gestion_ordenes.compra.compra_estado,
            gestion_ordenes.compra.compra_correo,
            gestion_ordenes.compra.compra_proyecto,
            gestion_ordenes.compra.compra_convenio,
            gestion_ordenes.compra.compra_anulada_por,
            gestion_ordenes.compra.compra_motivo_anulacion,
            gestion_ordenes.compra.compra_fecha_anulacion,
            gestion_ordenes.compra.created_at,
            gestion_ordenes.compra.updated_at,
            prespuestos.centrosdecostos.nombre as cc_nombre
            FROM
            gestion_ordenes.encargados_cc
            INNER JOIN gestion_ordenes.compra ON gestion_ordenes.compra.compra_cc = gestion_ordenes.encargados_cc.id_cc
            INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut
            INNER JOIN prespuestos.centrosdecostos ON gestion_ordenes.encargados_cc.id_cc = prespuestos.centrosdecostos.id AND gestion_ordenes.compra.compra_cc = prespuestos.centrosdecostos.id
            INNER JOIN prespuestos.centro_de_responsabilidad ON prespuestos.centrosdecostos.cr = prespuestos.centro_de_responsabilidad.id
            WHERE
            `rut_encargado` = "'.$request->run.'"
            AND `compra_amio` ='.$request->year.'
            AND `compra_estado` = '.$request->estado.'
            ORDER BY
            `compra_id` DESC');

        
        return $encargado_cc;

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
