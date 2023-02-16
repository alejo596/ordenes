<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compras; 
use App\HistorialOTs; 
use Illuminate\Support\Facades\DB;
class ComprasController extends Controller
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
      $fecha=date("Y-m-d h:m:s");  
      $anio = date('Y');
      $id_compra=Compras::where('compra_amio',$anio)->max('compra_numero');
      $id_c=$id_compra+1;
      $compra=new Compras();
      $compra->compra_numero=$id_c;
      $compra->compra_amio=$anio;
      $compra->compra_nombre_usuario_rut=$request->usuario;
      $compra->compra_cc=$request->cc_id;
      $compra->compra_sub_direccion=$request->cr_id;
      $compra->compra_fecha_guardada=$fecha;
      $compra->compra_rut_guardada=$request->usuario;
      $compra->compra_fecha_enviar=$fecha;
      $compra->compra_rut_enviar=$request->usuario;
      $compra->compra_estado=$request->estado;
      $compra->compra_correo=$request->mail;
      $compra->compra_telefono=$request->telefono;
      $compra->compra_convenio=$request->convenio;
      $compra->compra_proyecto=$request->proyecto;
      $compra->sigfe_presupuesto=$request->sigfe;
      $compra->save();

      $h=new HistorialOTs();
      $h->oc=$compra->id;
      $h->firma_creador=$request->usuario;
      $h->id_estado_timeline=1;
      $h->save();

      $update=Compras::where('compra_id',$compra->id)->update(['id_historial'=>$h->id]);
      return $compra->id;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ot_comprador($id)
    {

     $ot=DB::connection('ordenes_de_compras')->select('SELECT
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
       gestion_ordenes.compra.created_at,
       gestion_ordenes.compra.updated_at,
       presupuesto.centro_de_costo.cc_nombre,
       ssalud.persona.per_nombre,
       presupuesto.centro_de_responsabilidad.cr_nombre,
       gestion_ordenes.estados_ot.estado_nombre
       FROM
       gestion_ordenes.compra
       INNER JOIN presupuesto.centro_de_costo ON gestion_ordenes.compra.compra_cc = presupuesto.centro_de_costo.cc_id
       INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut COLLATE utf8_general_ci
       INNER JOIN presupuesto.centro_de_responsabilidad ON presupuesto.centro_de_costo.cc_cr_id = presupuesto.centro_de_responsabilidad.cr_id
       INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
       WHERE
        gestion_ordenes.compra.id_actividad=0   AND
       gestion_ordenes.compra.compra_sub_direccion ='.$id.' AND
       gestion_ordenes.compra.compra_estado in (7,8) AND
       gestion_ordenes.compra.compra_jefatura_sub_rut <> "" AND
       gestion_ordenes.compra.compra_jefatura_sub_aprueba_fecha IS NOT NULL
       ORDER BY
       gestion_ordenes.compra.compra_numero DESC
       ');
     return $ot;



   }
    public function show2($id)
   {
    $compra=Compras::select('gestion_ordenes.compra.compra_id',
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
      'gestion_ordenes.compra.id_historial',
      'gestion_ordenes.compra.sigfe_presupuesto',
      'gestion_ordenes.compra.created_at',
      'gestion_ordenes.compra.updated_at',
      'ssalud.persona.per_nombre','prespuestos.centrosdecostos.nombre AS centrocosto')
    ->where('compra_id',$id)
    ->join('ssalud.persona','ssalud.persona.per_rut','=','compra.compra_nombre_usuario_rut')//DB::raw('compra.compra_nombre_usuario_rut COLLATE utf8_general_ci'))
    ->join('prespuestos.centrosdecostos','gestion_ordenes.compra.compra_cc','=','prespuestos.centrosdecostos.id')
    ->first();
    return $compra;
  }
   public function show($id)
   {
    $compra=Compras::select('gestion_ordenes.compra.compra_id',
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
      'gestion_ordenes.compra.id_historial',
      'gestion_ordenes.compra.sigfe_presupuesto',
      'gestion_ordenes.compra.created_at',
      'gestion_ordenes.compra.updated_at',
      'ssalud.persona.per_nombre','prespuestos.centrosdecostos.nombre AS centrocosto')
    ->where('compra_id',$id)
    ->join('ssalud.persona','ssalud.persona.per_rut','=','compra.compra_nombre_usuario_rut')//DB::raw('compra.compra_nombre_usuario_rut COLLATE utf8_general_ci'))
    ->join('prespuestos.centrosdecostos','gestion_ordenes.compra.compra_cc','=','prespuestos.centrosdecostos.id')
    ->first();
    return $compra;
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
      $compra=Compras::where('compra_id',$id)->update($request->except('_method', '_token'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Compras::where('compra_id',$id)->delete();
    }
  }
