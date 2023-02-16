<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OTAsignari;

class OTAsignarController extends Controller
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

      $ot_asignar2=OTAsignari::select('gestion_ordenes.compra.compra_id',
            'gestion_ordenes.compra.id_historial',
            'gestion_ordenes.compra.sigfe_presupuesto',
            'gestion_ordenes.compra.compra_numero',
            'gestion_ordenes.compra.compra_amio',
            'gestion_ordenes.compra.compra_nombre_usuario_rut',
            'gestion_ordenes.compra.compra_cc',
            'gestion_ordenes.compra.compra_sub_direccion',
            'gestion_ordenes.compra.compra_jefatura_sub_rut',
            'gestion_ordenes.compra.compra_jefatura_sub_aprueba_fecha',
            'gestion_ordenes.compra.compra_encargado_cc_rut',
            'gestion_ordenes.compra.compra_encargado_cc_aprueba_fecha',
            'gestion_ordenes.compra.compra_fecha_guardada',
            'gestion_ordenes.compra.compra_rut_guardada',
            'gestion_ordenes.compra.compra_fecha_enviar',
            'gestion_ordenes.compra.compra_rut_enviar',
            'gestion_ordenes.compra.compra_asignada',
            'gestion_ordenes.compra.compra_estado',
            'gestion_ordenes.compra.compra_correo',
            'gestion_ordenes.compra.compra_proyecto',
            'gestion_ordenes.compra.compra_telefono',
            'gestion_ordenes.compra.compra_convenio',
            'gestion_ordenes.compra.compra_anulada_por',
            'gestion_ordenes.compra.compra_motivo_anulacion',
            'gestion_ordenes.compra.compra_fecha_anulacion',
            'presupuesto.centro_de_costo.cc_nombre',
            'ssalud.persona.per_nombre',
            'gestion_ordenes.estados_ot.estado_nombre',
            'presupuesto.centro_de_costo.cc_cr_id',
            'presupuesto.centro_de_responsabilidad.cr_nombre',
             'presupuesto.centro_de_costo.cc_id')
        ->join('presupuesto.centro_de_costo','gestion_ordenes.compra.compra_cc','=','presupuesto.centro_de_costo.cc_id')
        ->join('gestion_ordenes.estados_ot','gestion_ordenes.compra.compra_estado','=','gestion_ordenes.estados_ot.estado_id')
        ->join("ssalud.persona","gestion_ordenes.compra.compra_nombre_usuario_rut",'=','ssalud.persona.per_rut')
         ->join("presupuesto.centro_de_responsabilidad","presupuesto.centro_de_costo.cc_cr_id","=","presupuesto.centro_de_responsabilidad.cr_id") 
        ->where('compra_sub_direccion',$request->id_sub)
        ->whereIn('compra_cc',array($request->id_cc_sub,$request->id_cc_sub2))
        ->where('compra_estado','=',2)
        ->whereNull('compra_asignada')
        ->orderBy('compra_numero', 'DESC');
        $ot_asignar=OTAsignari::select('gestion_ordenes.compra.compra_id',
            'gestion_ordenes.compra.id_historial',
            'gestion_ordenes.compra.sigfe_presupuesto',
            'gestion_ordenes.compra.compra_numero',
            'gestion_ordenes.compra.compra_amio',
            'gestion_ordenes.compra.compra_nombre_usuario_rut',
            'gestion_ordenes.compra.compra_cc',
            'gestion_ordenes.compra.compra_sub_direccion',
            'gestion_ordenes.compra.compra_jefatura_sub_rut',
            'gestion_ordenes.compra.compra_jefatura_sub_aprueba_fecha',
            'gestion_ordenes.compra.compra_encargado_cc_rut',
            'gestion_ordenes.compra.compra_encargado_cc_aprueba_fecha',
            'gestion_ordenes.compra.compra_fecha_guardada',
            'gestion_ordenes.compra.compra_rut_guardada',
            'gestion_ordenes.compra.compra_fecha_enviar',
            'gestion_ordenes.compra.compra_rut_enviar',
            'gestion_ordenes.compra.compra_asignada',
            'gestion_ordenes.compra.compra_estado',
            'gestion_ordenes.compra.compra_correo',
            'gestion_ordenes.compra.compra_proyecto',
            'gestion_ordenes.compra.compra_telefono',
            'gestion_ordenes.compra.compra_convenio',
            'gestion_ordenes.compra.compra_anulada_por',
            'gestion_ordenes.compra.compra_motivo_anulacion',
            'gestion_ordenes.compra.compra_fecha_anulacion',
            'presupuesto.centro_de_costo.cc_nombre',
            'ssalud.persona.per_nombre',
            'gestion_ordenes.estados_ot.estado_nombre',
            'presupuesto.centro_de_costo.cc_cr_id',
            'presupuesto.centro_de_responsabilidad.cr_nombre',
             'presupuesto.centro_de_costo.cc_id')
        ->join('presupuesto.centro_de_costo','gestion_ordenes.compra.compra_cc','=','presupuesto.centro_de_costo.cc_id')
        ->join('gestion_ordenes.estados_ot','gestion_ordenes.compra.compra_estado','=','gestion_ordenes.estados_ot.estado_id')
        ->join("ssalud.persona","gestion_ordenes.compra.compra_nombre_usuario_rut",'=','ssalud.persona.per_rut')
         ->join("presupuesto.centro_de_responsabilidad","presupuesto.centro_de_costo.cc_cr_id","=","presupuesto.centro_de_responsabilidad.cr_id") 
        ->where('compra_sub_direccion',$request->id_sub)
        ->where('compra_estado','=',3)
        ->whereNull('compra_asignada')
        ->orderBy('compra_numero', 'DESC')
        ->union($ot_asignar2)
        ->get();

        return  $ot_asignar;


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
