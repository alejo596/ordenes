<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenesdeCompras;
use Illuminate\Support\Facades\DB;

class OrdenesdeComprasController extends Controller
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

    public function buscadorxid(Request $request)
    {
     $order=DB::connection('ordenes_de_compras')->select('SELECT
    *, DATE(
        compra.compra_jefatura_sub_aprueba_fecha
        ) AS fecha_sub,
    TIME(
        compra.compra_jefatura_sub_aprueba_fecha
        ) AS hora_sub,
    presupuesto.centro_de_costo.cc_nombre,
    gestion_ordenes.estados_ot.estado_nombre,
    ssalud.persona.per_rut,
    ssalud.persona.per_nombre
    FROM
    compra
    INNER JOIN presupuesto.centro_de_costo ON gestion_ordenes.compra.compra_cc = presupuesto.centro_de_costo.cc_id
    INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
    LEFT JOIN gestion_ordenes.aprobar_nivel1 ON gestion_ordenes.compra.compra_id = gestion_ordenes.aprobar_nivel1.id_ot
    INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut COLLATE utf8_general_ci 
    WHERE 
    YEAR(compra.compra_fecha_enviar) = '.$request->year.' AND  

    compra.compra_numero='.$request->ot.'

    ORDER BY
    compra.compra_fecha_enviar DESC');

     return $order;

 }
 public function ot_generadas_por_cc_y_fecha(Request $request)
 {
  $order=DB::connection('ordenes_de_compras')->select('SELECT
    *, DATE(
    compra.compra_jefatura_sub_aprueba_fecha
    ) AS fecha_sub,
    TIME(
        compra.compra_jefatura_sub_aprueba_fecha
        ) AS hora_sub,
    presupuesto.centro_de_costo.cc_nombre,
    gestion_ordenes.estados_ot.estado_nombre,
    ssalud.persona.per_rut,
    ssalud.persona.per_nombre
    FROM
    compra
    INNER JOIN presupuesto.centro_de_costo ON gestion_ordenes.compra.compra_cc = presupuesto.centro_de_costo.cc_id
    INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
    LEFT JOIN gestion_ordenes.aprobar_nivel1 ON gestion_ordenes.compra.compra_id = gestion_ordenes.aprobar_nivel1.id_ot
    INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut COLLATE utf8_general_ci 
    WHERE 
    YEAR(compra.compra_fecha_enviar) = '.$request->year.' AND  
    MONTH(compra.compra_fecha_enviar) = '.$request->mes.' AND 
    compra.compra_numero IS NOT NULL AND 
    compra.compra_cc = '.$request->cc.'
    ORDER BY
    compra.compra_fecha_enviar DESC');

  return $order;
}
public function ot_generadas_sin_cc_amio(Request $request)
{

  $order=DB::connection('ordenes_de_compras')->select('SELECT
    gestion_ordenes.compra.compra_id AS id_ot,
    gestion_ordenes.compra.compra_id,
    gestion_ordenes.compra.compra_numero,
    gestion_ordenes.compra.compra_amio,
    gestion_ordenes.compra.compra_nombre_usuario_rut,
    gestion_ordenes.compra.compra_cc,
    gestion_ordenes.compra.compra_sub_direccion,
    gestion_ordenes.compra.compra_jefatura_sub_rut,
    gestion_ordenes.compra.compra_jefatura_sub_aprueba_fecha,
    gestion_ordenes.compra.compra_encargado_cc_rut,
    gestion_ordenes.compra.compra_encargado_cc_aprueba_fecha,
    gestion_ordenes.compra.compra_fecha_guardada,
    gestion_ordenes.compra.compra_rut_guardada,
    gestion_ordenes.compra.compra_fecha_enviar,
    gestion_ordenes.compra.compra_rut_enviar,
    gestion_ordenes.compra.compra_asignada,
    gestion_ordenes.compra.compra_estado,
    gestion_ordenes.compra.compra_correo,
    gestion_ordenes.compra.compra_proyecto,
    gestion_ordenes.compra.compra_telefono,
    gestion_ordenes.compra.compra_convenio,
    gestion_ordenes.compra.compra_anulada_por,
    gestion_ordenes.compra.compra_motivo_anulacion,
    gestion_ordenes.compra.compra_fecha_anulacion,
    gestion_ordenes.compra.id_historial,
    gestion_ordenes.compra.sigfe_presupuesto,
    gestion_ordenes.compra.id_observacion,
    gestion_ordenes.compra.created_at,
    gestion_ordenes.compra.updated_at,
    prespuestos.centrosdecostos.nombre as cc_nombre,
    gestion_ordenes.estados_ot.estado_nombre,
    DATE(compra.compra_jefatura_sub_aprueba_fecha) AS fecha_sub,
    TIME(compra.compra_jefatura_sub_aprueba_fecha) AS hora_sub,
    DATE(compra.compra_fecha_guardada) AS fecha_guardada,
    DATE(compra.compra_fecha_enviar) AS fecha_registrada,
    DATE(compra.compra_asignada) AS fecha_asignada,
    ssalud.persona.per_rut,
    ssalud.persona.per_nombre

    FROM
    gestion_ordenes.compra
    INNER JOIN prespuestos.centrosdecostos ON gestion_ordenes.compra.compra_cc = prespuestos.centrosdecostos.id
    INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
    INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut COLLATE utf8_general_ci

    where gestion_ordenes.compra.compra_amio='.$request->year.' and compra.compra_nombre_usuario_rut="'.$request->rut.'"
    ORDER BY id_ot DESC
    ');


  return $order;
}

public function store(Request $request)
{
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show2($id)
    { 


     $ot= DB::connection('ordenes_de_compras')->select( "SELECT
        prespuestos.centrosdecostos.id AS cc_id,
        prespuestos.centrosdecostos.nombre AS cc_nombre,
        prespuestos.centro_de_responsabilidad.nombre AS cr_nombre,
        compra.compra_id,
        compra.compra_numero,
        compra.compra_amio,
        compra.compra_nombre_usuario_rut,
        compra.compra_cc,
        compra.compra_sub_direccion,
        compra.compra_jefatura_sub_rut,
        compra.compra_jefatura_sub_aprueba_fecha,
        compra.compra_encargado_cc_rut,
        compra.compra_encargado_cc_aprueba_fecha,
        compra.compra_fecha_guardada,
        compra.compra_rut_guardada,
        compra.compra_fecha_enviar,
        compra.compra_rut_enviar,
        compra.compra_asignada,
        compra.compra_estado,
        compra.compra_correo,
        compra.compra_proyecto,
        compra.compra_telefono,
        compra.compra_convenio,
        compra.compra_anulada_por,
        compra.compra_motivo_anulacion,
        compra.compra_fecha_anulacion,
        compra.id_historial,
        sigfe_presupuesto,
        ssalud.persona.per_nombre
        FROM
        compra
        INNER JOIN prespuestos.centrosdecostos ON gestion_ordenes.compra.compra_cc = prespuestos.centrosdecostos.id
        INNER JOIN ssalud.persona ON ssalud.persona.per_rut = compra.compra_nombre_usuario_rut 
        INNER JOIN prespuestos.centro_de_responsabilidad ON prespuestos.centrosdecostos.cr = prespuestos.centro_de_responsabilidad.id
        WHERE
        compra.compra_id ='".$id."'");
//INNER JOIN ssalud.persona ON ssalud.persona.per_rut = compra.compra_nombre_usuario_rut COLLATE utf8_general_ci
     return $ot;
 }
    public function show($id)
    { 


     $ot= DB::connection('ordenes_de_compras')->select( "SELECT
        prespuestos.centrosdecostos.id AS cc_id,
        prespuestos.centrosdecostos.nombre AS cc_nombre,
        prespuestos.centro_de_responsabilidad.nombre AS cr_nombre,
        compra.compra_id,
        compra.compra_numero,
        compra.compra_amio,
        compra.compra_nombre_usuario_rut,
        compra.compra_cc,
        compra.compra_sub_direccion,
        compra.compra_jefatura_sub_rut,
        compra.compra_jefatura_sub_aprueba_fecha,
        compra.compra_encargado_cc_rut,
        compra.compra_encargado_cc_aprueba_fecha,
        compra.compra_fecha_guardada,
        compra.compra_rut_guardada,
        compra.compra_fecha_enviar,
        compra.compra_rut_enviar,
        compra.compra_asignada,
        compra.compra_estado,
        compra.compra_correo,
        compra.compra_proyecto,
        compra.compra_telefono,
        compra.compra_convenio,
        compra.compra_anulada_por,
        compra.compra_motivo_anulacion,
        compra.compra_fecha_anulacion,
        compra.id_historial,
        sigfe_presupuesto,
        ssalud.persona.per_nombre
        FROM
        compra
        INNER JOIN prespuestos.centrosdecostos ON gestion_ordenes.compra.compra_cc = prespuestos.centrosdecostos.id
        INNER JOIN ssalud.persona ON ssalud.persona.per_rut = compra.compra_nombre_usuario_rut 
        INNER JOIN prespuestos.centro_de_responsabilidad ON prespuestos.centrosdecostos.cr = prespuestos.centro_de_responsabilidad.id
        WHERE
        compra.compra_rut_guardada ='".$id."'");
//INNER JOIN ssalud.persona ON ssalud.persona.per_rut = compra.compra_nombre_usuario_rut COLLATE utf8_general_ci
     return $ot;
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
       OrdenesdeCompras::where('compra_id',$id)->update($request->except('_method', '_token'));

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
