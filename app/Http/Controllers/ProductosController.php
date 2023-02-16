<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productos;
use App\Year;
use App\Refrendacio_envios;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p=Productos::all();
        return $p;
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





      $year=Year::where('estado',1)->first();


      if($request->sub_item_sigfe =='null'){
        $request->sub_item_sigfe=NULL;
      }    
      $p=new Productos();       
      $p->pro_id_oc=$request->oc;
      $p->pro_nombre=$request->nombre;
      $p->pro_cantidad=$request->cantidad;
      $p->pro_descripcion=$request->detalle;
      $p->pro_precio=$request->precio;
      $p->pro_id_aba=$request->id_pro;     
      $p->pro_ordenados_por_numero=$request->id; 
      $p->pro_cuenta_sigfe=$request->cuenta;
      $p->pro_total=$request->total;
      $p->pro_uindad_medida=$request->unidad;
      $p->pro_nombre_sigfe=$request->nombre_sigfe;
      $p->pro_nombre_producto=$request->nombre_producto;
      $p->pro_sub_item_sigfe=$request->sub_item_sigfe;
      $p->pro_estado_producto=$request->estado;
      $p->pro_justificacion=$request->justificacion;
      $p->pro_cc=$request->cc;       
      $p->pro_amio=$year->year;
      $p->pro_convenio=$request->convenio;
      $p->pro_cantidad_solicitud=$request->cantidad; 
      $p->pro_costo_unitario_incluye_todo=$request->precio_todo;
      $p->pro_id_cpp=$request->pro_id_cpp;
      $p->pro_precio_unitario=$request->pro_precio_unitario;
      $p->pro_cantidad_unitario=$request->pro_cantidad_unitario;
      $p->sigfe_item=$request->sigfe_item;
       $p->pro_ID_ZGEN=$request->zgen;
      $p->save(); 
      return $p->id;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function totalproductosenviadosarefrendar(Request $request)
    {
     $sql=DB::connection('ordenes_de_compras')->select(
      'SELECT
      Sum(producto_compra.pro_costo_unitario_incluye_todo) AS todo,
      producto_compra.pro_cc,
      producto_compra.pro_id_cpp,
      producto_compra.sigfe_item,
      producto_compra.pro_amio,
      producto_compra.pro_id
      FROM
      producto_compra
      WHERE producto_compra.pro_id_cpp='.$request->cpp.'
      GROUP BY producto_compra.pro_cc,producto_compra.sigfe_item');

     foreach ($sql as $key) {
      $e=new Refrendacio_envios();
      $e->id_refrendacion=$request->refrendacion;     
      $e->monto=$key->todo;
      $e->cc=$key->pro_cc;
      $e->sigfe=$key->sigfe_item;      
      $e->year=$key->pro_amio;
      $e->id_producto=$key->pro_id;
      $e->save();

    }

    return $sql;
  }

  public function buscar_productos_cpp(Request $request)
  {

    $sql=Productos::select('gestion_ordenes.compromisos.id','gestion_ordenes.compromisos.numero', 'gestion_ordenes.compromisos.year', 'gestion_ordenes.compra.compra_numero', 'gestion_ordenes.compra.compra_amio', 'gestion_ordenes.producto_compra.pro_cc', 'prespuestos.centrosdecostos.nombre as cc', 'prespuestos.centro_de_responsabilidad.nombre as cr', 'gestion_ordenes.estado_cpp.nombre as estado', 'ssalud.persona.per_nombre as nombre', 'gestion_ordenes.cpp_historial_observaciones.observacion', 'gestion_ordenes.compromisos.id_observacion', 'gestion_ordenes.compromisos.usuario', 'bodega_inventario.recepcion_bodega.num_recepcion', 'gestion_ordenes.proveedores.id as id_proveedor', 'gestion_ordenes.proveedores.run as run_proveedor', 'gestion_ordenes.proveedores.nombre as nombre_proveedor', 'gestion_ordenes.compromisos.total','gestion_ordenes.compromisos.oc','gestion_ordenes.compromisos.ocportal','gestion_ordenes.producto_compra.id_proceso')
    ->join('gestion_ordenes.compromisos','gestion_ordenes.producto_compra.pro_id_cpp','=','gestion_ordenes.compromisos.id')
    ->leftJoin('gestion_ordenes.compra','gestion_ordenes.producto_compra.pro_id_oc','=','gestion_ordenes.compra.compra_id')
    ->join('prespuestos.centrosdecostos','gestion_ordenes.producto_compra.pro_cc','=','prespuestos.centrosdecostos.id')
    ->join('prespuestos.centro_de_responsabilidad','prespuestos.centrosdecostos.cr','=','prespuestos.centro_de_responsabilidad.id')
    ->join('gestion_ordenes.estado_cpp','gestion_ordenes.compromisos.estado','=','gestion_ordenes.estado_cpp.id')
    ->join('ssalud.persona',DB::raw('gestion_ordenes.compromisos.usuario'),'=',DB::raw('ssalud.persona.per_rut COLLATE utf8_general_ci'))
    ->join('gestion_ordenes.cpp_historial_observaciones','gestion_ordenes.compromisos.id_observacion','=','gestion_ordenes.cpp_historial_observaciones.id')
    ->leftJoin('bodega_inventario.recepcion_bodega','bodega_inventario.recepcion_bodega.id_cpp','=','gestion_ordenes.compromisos.id')
    ->join('gestion_ordenes.proveedores','gestion_ordenes.compromisos.id_proveedor','=','gestion_ordenes.proveedores.id')
    ->where(function($query) use ($request) {
      if($request->yearcpp != ''){
        return $query->where('gestion_ordenes.compromisos.year','=',$request->yearcpp);

      }

    })

    ->where(function($query) use ($request) {
      if($request->cpp != '')
      {
       return $query->where('gestion_ordenes.compromisos.numero','=',$request->cpp);  
     }
   })

    ->where(function($query) use ($request) {
     if($request->proveedor !='') {
      return $query->orWhere('gestion_ordenes.proveedores.id','=',$request->proveedor);
    }

  })

    ->where(function($query) use ($request) {
      if($request->estado != '') {
        return $query->where('gestion_ordenes.estado_cpp.id','=',$request->estado);
      }

    })
    ->where(function($query) use ($request) {
      if($request->numero != ''){
        $query->orWhere('gestion_ordenes.compra.compra_numero','=',$request->numero);
      }
    })
    ->where(function($query) use ($request) {
      if($request->yearot != 0)
      {
        return $query->where('gestion_ordenes.compra.compra_amio','=',$request->yearot);
      }
    })
    ->where(function($query) use ($request) {
      if($request->creado != ''){
       return $query->where('gestion_ordenes.compromisos.usuario','=',$request->creado);
     }
   })
    ->where(function($query) use ($request) {
      if($request->cc != '')
      {
        return $query->where('gestion_ordenes.producto_compra.pro_cc','=',$request->cc);
      }
    })

    ->groupBy('gestion_ordenes.compromisos.id')
    ->get();
    return $sql;

  }
  public function productos_procesos(Request $request)
  {


    $sql=Productos::select('producto_compra.pro_id_oc','compra.compra_numero','producto_compra.pro_cantidad as cantidad' ,'procesos.created_at', 'producto_compra.pro_id', 'producto_compra.pro_nombre', 'producto_compra.pro_descripcion', 'producto_compra.pro_total', 'estado_producto.nombre', 'compromisos.numero as cpp_numero', 'estado_cpp.nombre as estado_cpp', 'proveedores.nombre as proveedor', 'compra.compra_amio', 'funcionarios_compra.per_nombre', 'producto_compra.id_proceso')
    ->leftjoin('procesos','procesos.id','=','producto_compra.id_proceso')
    ->join('compra','producto_compra.pro_id_oc','=','compra.compra_id')
    ->join('estado_producto','producto_compra.pro_estado_producto','=','estado_producto.id')
    ->leftJoin('compromisos','producto_compra.pro_id_cpp','=','compromisos.id')
    ->leftJoin('estado_cpp','compromisos.estado','=','estado_cpp.id')
    ->leftJoin('proveedores','compromisos.id_proveedor','=','proveedores.id')
    ->leftjoin('funcionarios_compra','producto_compra.pro_comprador','=','funcionarios_compra.id')
    ->where('producto_compra.pro_estado_producto','!=',13)
    ->where(function($query) use ($request) {
      if($request->comprador != ''){
        return $query->where('funcionarios_compra.id','=',$request->comprador);

      }
    })
    ->where(function($query) use ($request){
      if($request->year != ''){
        return $query->where('compra.compra_amio','=',$request->year);
      }
    })
    ->where(function($query) use ($request){
      if($request->numero != ''){
        return $query->where('compra.compra_numero','=',$request->numero);
      }
    })
    
    ->get();

    return $sql;

  }
  public function lista_editar_productos($id)
  {
    $productos=DB::connection('ordenes_de_compras')->select('SELECT
      ROW_NUMBER() OVER (ORDER BY producto_compra.pro_id) as indice,
      1  as crud,
      producto_compra.pro_id,
      producto_compra.pro_id_oc,
      producto_compra.pro_nombre,
      producto_compra.pro_cantidad,
      producto_compra.pro_descripcion,
      producto_compra.pro_precio,
      producto_compra.pro_id_aba,
      producto_compra.pro_ordenados_por_numero,
      producto_compra.pro_comprador,
      producto_compra.pro_id_detalle_compra,
      producto_compra.pro_oc_portal_id,
      producto_compra.pro_id_cpp,
      producto_compra.pro_estado_refrendacion,
      producto_compra.pro_cuenta_sigfe,
      producto_compra.pro_total,
      producto_compra.pro_uindad_medida,
      producto_compra.pro_nombre_sigfe,
      producto_compra.pro_nombre_producto,
      producto_compra.pro_sub_item_sigfe,
      producto_compra.pro_estado_producto,
      producto_compra.pro_estado_producto_anterior,
      producto_compra.pro_costo_unitario_incluye_todo,
      producto_compra.pro_justificacion,
      producto_compra.pro_cc,
      producto_compra.pro_oc_portal_individual,
      producto_compra.pro_amio,
      producto_compra.pro_convenio,
      producto_compra.pro_cantidad_solicitud,
      producto_compra.pro_precio_unitario,
      producto_compra.pro_cantidad_unitario,
      producto_compra.pro_costo_unitario_producto_sin_ajuste,
      producto_compra.pro_costo_unitario_ajuste,
      producto_compra.pro_factura_unitaria,
      producto_compra.pro_diferencia_adicionada,
      producto_compra.pro_ID_ZGEN as zgen,
      producto_compra.id_proceso,
      producto_compra.sigfe_item,
      producto_compra.pro_observacion,
      producto_compra.created_at,
      producto_compra.updated_at
      FROM
      producto_compra
      where producto_compra.pro_id_oc='.$id);

    return $productos;
  }
  public function productos_comprador($id)
  {
    $productos=DB::connection('ordenes_de_compras')->select('SELECT
      0 as crud,
      gestion_ordenes.producto_compra.pro_id,
      gestion_ordenes.producto_compra.pro_id_oc,
      gestion_ordenes.producto_compra.pro_nombre,
      gestion_ordenes.producto_compra.pro_cantidad,
      gestion_ordenes.producto_compra.pro_descripcion,
      gestion_ordenes.producto_compra.pro_precio,
      gestion_ordenes.producto_compra.pro_id_aba,
      gestion_ordenes.producto_compra.pro_ordenados_por_numero,
      gestion_ordenes.producto_compra.pro_comprador,
      gestion_ordenes.producto_compra.pro_id_detalle_compra,
      gestion_ordenes.producto_compra.pro_oc_portal_id,
      gestion_ordenes.producto_compra.pro_id_cpp,
      gestion_ordenes.producto_compra.pro_estado_refrendacion,
      gestion_ordenes.producto_compra.pro_cuenta_sigfe,
      gestion_ordenes.producto_compra.pro_total,
      gestion_ordenes.producto_compra.pro_uindad_medida,
      gestion_ordenes.producto_compra.pro_nombre_sigfe,
      gestion_ordenes.producto_compra.pro_nombre_producto,
      gestion_ordenes.producto_compra.pro_sub_item_sigfe,
      gestion_ordenes.producto_compra.pro_estado_producto,
      gestion_ordenes.producto_compra.pro_estado_producto_anterior,
      gestion_ordenes.producto_compra.pro_costo_unitario_incluye_todo,
      gestion_ordenes.producto_compra.pro_justificacion,
      gestion_ordenes.producto_compra.pro_cc,
      gestion_ordenes.producto_compra.pro_oc_portal_individual,
      gestion_ordenes.producto_compra.pro_amio,
      gestion_ordenes.producto_compra.pro_convenio,
      gestion_ordenes.producto_compra.pro_cantidad_solicitud,
      gestion_ordenes.producto_compra.pro_precio_unitario,
      gestion_ordenes.producto_compra.pro_cantidad_unitario,
      gestion_ordenes.producto_compra.pro_costo_unitario_producto_sin_ajuste,
      gestion_ordenes.producto_compra.pro_costo_unitario_ajuste,
      gestion_ordenes.producto_compra.pro_factura_unitaria,
      gestion_ordenes.producto_compra.pro_diferencia_adicionada,
      gestion_ordenes.producto_compra.pro_ID_ZGEN,
      gestion_ordenes.producto_compra.id_proceso,
      gestion_ordenes.producto_compra.created_at,
      gestion_ordenes.producto_compra.updated_at,
      gestion_ordenes.compra.compra_numero,
      gestion_ordenes.estados_ot.estado_nombre,
      presupuesto.centro_de_costo.cc_nombre,
      presupuesto.centro_de_responsabilidad.cr_nombre,
      gestion_ordenes.historial_ots.id,
      gestion_ordenes.historial_ots.oc,
      gestion_ordenes.historial_ots.id_estado_timeline,
      gestion_ordenes.historial_ots.firma_creador,
      gestion_ordenes.historial_ots.firma_encargado,
      gestion_ordenes.historial_ots.fecha_encargado,
      gestion_ordenes.historial_ots.firma_cc,
      gestion_ordenes.historial_ots.fecha_cc,
      gestion_ordenes.historial_ots.firma_sub,
      gestion_ordenes.historial_ots.fecha_sub,
      gestion_ordenes.historial_ots.firma_jcompras,
      gestion_ordenes.historial_ots.fecha_jcompras,
      gestion_ordenes.historial_ots.firma_comprador,
      gestion_ordenes.historial_ots.fecha_comprador,
      gestion_ordenes.historial_ots.firma_final,
      gestion_ordenes.historial_ots.fecha_final,
      gestion_ordenes.historial_ots.created_at,
      gestion_ordenes.historial_ots.updated_at,
      gestion_ordenes.compra.compra_nombre_usuario_rut,
      ssalud.persona.per_nombre as usuario,
      gestion_ordenes.pro_asignar.created_at AS fecha_asignar
      FROM
      gestion_ordenes.producto_compra
      INNER JOIN gestion_ordenes.compra ON gestion_ordenes.producto_compra.pro_id_oc = gestion_ordenes.compra.compra_id
      INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
      LEFT JOIN presupuesto.centro_de_costo ON gestion_ordenes.producto_compra.pro_cc = presupuesto.centro_de_costo.cc_id
      LEFT JOIN presupuesto.centro_de_responsabilidad ON presupuesto.centro_de_costo.cc_cr_id = presupuesto.centro_de_responsabilidad.cr_id
      LEFT JOIN gestion_ordenes.historial_ots ON gestion_ordenes.compra.compra_id = gestion_ordenes.historial_ots.oc
      LEFT JOIN gestion_ordenes.funcionarios_compra ON gestion_ordenes.producto_compra.pro_comprador = gestion_ordenes.funcionarios_compra.id
      INNER JOIN ssalud.persona ON gestion_ordenes.compra.compra_nombre_usuario_rut = ssalud.persona.per_rut COLLATE utf8_general_ci
      INNER JOIN gestion_ordenes.pro_asignar ON gestion_ordenes.producto_compra.pro_id = gestion_ordenes.pro_asignar.pro_id
      WHERE gestion_ordenes.historial_ots.id_estado_timeline in(8) and gestion_ordenes.producto_compra.pro_estado_producto=1 and gestion_ordenes.funcionarios_compra.per_id="'.$id.'"');

return $productos;
}

public function buscarotproductos(Request $request)
{  
  $sql=Productos::select(DB::raw(' ""  as detalles'),'prespuestos.centrosdecostos.cr','gestion_ordenes.compra.compra_id', 'gestion_ordenes.compra.compra_amio', 'gestion_ordenes.producto_compra.pro_id', 'gestion_ordenes.compra.compra_numero', 'prespuestos.centrosdecostos.id as id_cc', 'prespuestos.centrosdecostos.nombre as cc', 'prespuestos.centro_de_responsabilidad.nombre as cr', 'gestion_ordenes.producto_compra.pro_nombre', 'gestion_ordenes.producto_compra.pro_descripcion','gestion_ordenes.estados_ot.estado_nombre', 'gestion_ordenes.compra.created_at as fecha_compra','gestion_ordenes.estado_producto.nombre as estado_producto')
  ->join('gestion_ordenes.compra','gestion_ordenes.producto_compra.pro_id_oc','=','gestion_ordenes.compra.compra_id')
  ->join('prespuestos.centrosdecostos','gestion_ordenes.producto_compra.pro_cc','=','prespuestos.centrosdecostos.id')
  ->join('prespuestos.centro_de_responsabilidad','prespuestos.centrosdecostos.cr','=','prespuestos.centro_de_responsabilidad.id')
  ->join('gestion_ordenes.estados_ot','gestion_ordenes.compra.compra_estado','=','gestion_ordenes.estados_ot.estado_id')
  ->join('gestion_ordenes.estado_producto','gestion_ordenes.producto_compra.pro_estado_producto','=','gestion_ordenes.estado_producto.id')

  ->where(function($query) use ($request) {
    if($request->cc != '')
    {
      return $query->where('prespuestos.centrosdecostos.id','=',$request->cc);
    }
  })
  ->where(function($query) use ($request) {
   if($request->cr != '')
   {
    return $query->where('prespuestos.centrosdecostos.cr','=',$request->cr);
  }
})
  ->where(function($query) use ($request) {
   if($request->numero != '')
   {
    return $query->where('gestion_ordenes.compra.compra_numero','=',$request->numero);
  }
})
  ->where(function($query) use ($request) {
   if($request->nombre != '')
   {
    return $query->where('gestion_ordenes.producto_compra.pro_nombre','like','%'.$request->nombre.'%');
  }
})
  ->where(function($query) use ($request) {
   if($request->inicio != '')
   {
    return $query->whereBetween('gestion_ordenes.compra.created_at',[date($request->inicio),date($request->terminar)]);
  }
})
  ->where('gestion_ordenes.compra.compra_amio','=',$request->year)
//->groupBy('gestion_ordenes.compra.compra_numero')
  ->get()->toArray();



  $sql3=array();
  $e=0;

  while ($e <count($sql))  {

    $sql2[$e]=array(
      "pro_id"=>$sql[$e]['compra_id'],
      "pro_nombre"=>$sql[$e]['pro_nombre'],
      "pro_descripcion"=>$sql[$e]['pro_descripcion'],
      "estado_producto"=>$sql[$e]['estado_producto']);



    $e++;

  }


  for ($i=0; $i <count($sql) ; $i++) { 
    if($i == 0 ){
      $id=$sql[$i]['compra_id'];  

      $amio=$sql[$i]['compra_amio'];
      $numero=$sql[$i]['compra_numero'];

      $sql3[$i]['cc']=$sql[$i]['cc'];
      $sql3[$i]['cr']=$sql[$i]['cr'];

      $sql3[$i]['compra_amio']=$sql[$i]['compra_amio'];
      $sql3[$i]['compra_numero']=$sql[$i]['compra_numero'];
      $sql3[$i]['compra_id']=$sql[$i]['compra_id'];
      $sql3[$i]['created_at']=$sql[$i]['fecha_compra'];

      $sql3[$i]['estado_nombre']=$sql[$i]['estado_nombre'];
      $sql3[$i]['id_cc']=$sql[$i]['id_cc'];
      $sql[$i]['pro_descripcion']=$sql[$i]['pro_descripcion'];
      for ($j=0; $j <count($sql2) ; $j++) { 

        if ($sql2[$j]['pro_id'] == $sql[$i]['compra_id']) {

         $sql3[$i]['detalles'][$j]=array(
          "pro_nombre"=>$sql2[$j]['pro_nombre'],
          "pro_descripcion"=>$sql2[$j]['pro_descripcion'],
          "estado_producto"=>$sql2[$j]['estado_producto']
        );

       }
     }

   }else{


     if($id != $sql[$i]['compra_id']){

      $id=$sql[$i]['compra_id'];  

      $amio=$sql[$i]['compra_amio'];
      $numero=$sql[$i]['compra_numero'];

      $sql3[$i]['cc']=$sql[$i]['cc'];
      $sql3[$i]['cr']=$sql[$i]['cr'];

      $sql3[$i]['compra_amio']=$sql[$i]['compra_amio'];
      $sql3[$i]['compra_numero']=$sql[$i]['compra_numero'];
      $sql3[$i]['compra_id']=$sql[$i]['compra_id'];
      $sql3[$i]['created_at']=$sql[$i]['fecha_compra'];

      $sql3[$i]['estado_nombre']=$sql[$i]['estado_nombre'];
      $sql3[$i]['id_cc']=$sql[$i]['id_cc'];
      $sql3[$i]['pro_descripcion']=$sql[$i]['pro_descripcion'];
      for ($j=0; $j <count($sql2) ; $j++) { 
        if ($sql2[$j]['pro_id'] == $sql[$i]['compra_id']) {   

         $sql3[$i]['detalles'][$j]=array(
          "pro_nombre"=>$sql2[$j]['pro_nombre'],
          "pro_descripcion"=>$sql2[$j]['pro_descripcion'],
          "estado_producto"=>$sql2[$j]['estado_producto']
        );

       }
     }
   } 

 }
}




return array_values($sql3);


}
public function productosconvenios($id)
{
 $productos=DB::connection('ordenes_de_compras')->select('SELECT
producto_compra.pro_id,
producto_compra.pro_id_oc,
producto_compra.pro_nombre,
producto_compra.pro_cantidad,
producto_compra.pro_descripcion,
producto_compra.pro_precio,
producto_compra.pro_id_aba,
producto_compra.pro_ordenados_por_numero,
producto_compra.pro_comprador,
producto_compra.pro_id_detalle_compra,
producto_compra.pro_oc_portal_id,
producto_compra.pro_id_cpp,
producto_compra.pro_estado_refrendacion,
producto_compra.pro_cuenta_sigfe,
producto_compra.pro_total,
producto_compra.pro_uindad_medida,
producto_compra.pro_nombre_sigfe,
producto_compra.pro_nombre_producto,
producto_compra.pro_sub_item_sigfe,
producto_compra.pro_estado_producto,
producto_compra.pro_estado_producto_anterior,
producto_compra.pro_costo_unitario_incluye_todo,
producto_compra.pro_justificacion,
producto_compra.pro_cc,
producto_compra.pro_oc_portal_individual,
producto_compra.pro_amio,
producto_compra.pro_convenio,
producto_compra.pro_cantidad_solicitud,
producto_compra.pro_precio_unitario,
producto_compra.pro_cantidad_unitario,
producto_compra.pro_costo_unitario_producto_sin_ajuste,
producto_compra.pro_costo_unitario_ajuste,
producto_compra.pro_factura_unitaria,
producto_compra.pro_diferencia_adicionada,
producto_compra.pro_ID_ZGEN,
producto_compra.id_proceso,
producto_compra.sigfe_item,
producto_compra.pro_observacion,
producto_compra.created_at,
producto_compra.updated_at,
convenio_productos.convenio
FROM
producto_compra
INNER JOIN convenio_productos ON producto_compra.pro_id = convenio_productos.producto
where producto_compra.pro_estado_producto=16 and convenio_productos.convenio="'.$id.'"');

 return $productos;
}
public function productoconetapa($id)
{
  $productos=DB::connection('ordenes_de_compras')->select('SELECT
    compra.compra_numero,
    etapas.nombre,
    etapas.total,
    producto_compra.pro_nombre,
    producto_compra.pro_cantidad,
    producto_compra.pro_descripcion,
    producto_compra.pro_precio,
    producto_compra.pro_id_aba,
    producto_compra.pro_id,
    producto_compra.pro_cantidad_solicitud,
    historial_tipo_compra.id,
    historial_tipo_compra.etapa_nombre,
    historial_tipo_compra.estado,
    historial_tipo_compra.tipo_compra,
    historial_tipo_compra.id_ot,
    historial_tipo_compra.id_pro,
    historial_tipo_compra.lictacion_numero,
    historial_tipo_compra.licitacion_fecha,
    historial_tipo_compra.licitacion_nombre,
    historial_tipo_compra.licitacion_estado,
    historial_tipo_compra.licitacion_cierre,
    historial_tipo_compra.id_historial_detalle,
    historial_tipo_compra.observacion,
    historial_tipo_compra.fecha_inicio,
    historial_tipo_compra.created_at,
    historial_tipo_compra.updated_at,
    funcionarios_compra.per_id,
    estado_proceso_compra.id_proce_compra_nombre,
    compra.compra_amio
    FROM
    historial_tipo_compra
    INNER JOIN compra ON historial_tipo_compra.id_ot = compra.compra_id
    INNER JOIN etapas ON etapas.id = historial_tipo_compra.tipo_compra
    INNER JOIN producto_compra ON historial_tipo_compra.id_pro = producto_compra.pro_id
    INNER JOIN funcionarios_compra ON producto_compra.pro_comprador = funcionarios_compra.id
    INNER JOIN estado_proceso_compra ON historial_tipo_compra.estado = estado_proceso_compra.id_proce_compra
    where funcionarios_compra.per_id="'.$id.'"');

  return $productos;

}

public function producto_compra_sin_cpp($id)
{
  $productos=DB::connection('ordenes_de_compras')->select('SELECT
    0 as estadocreado,
    producto_compra.pro_id,
    producto_compra.pro_id_oc,
    producto_compra.pro_nombre,
    producto_compra.pro_cantidad,
    producto_compra.pro_descripcion,
    producto_compra.pro_precio,
    producto_compra.pro_id_aba,
    producto_compra.pro_ordenados_por_numero,
    producto_compra.pro_comprador,
    producto_compra.pro_id_detalle_compra,
    producto_compra.pro_oc_portal_id,
    producto_compra.pro_id_cpp,
    producto_compra.pro_estado_refrendacion,
    producto_compra.pro_cuenta_sigfe,
    producto_compra.pro_total,
    producto_compra.pro_uindad_medida,
    producto_compra.pro_nombre_sigfe,
    producto_compra.pro_nombre_producto,
    producto_compra.pro_sub_item_sigfe,
    producto_compra.pro_estado_producto,
    producto_compra.pro_estado_producto_anterior,
    producto_compra.pro_costo_unitario_incluye_todo,
    producto_compra.pro_justificacion,
    producto_compra.pro_cc,
    producto_compra.pro_oc_portal_individual,
    producto_compra.pro_amio,
    producto_compra.pro_convenio,
    producto_compra.pro_cantidad_solicitud,
    producto_compra.pro_precio_unitario,
    producto_compra.pro_cantidad_unitario,
    producto_compra.pro_costo_unitario_producto_sin_ajuste,
    producto_compra.pro_costo_unitario_ajuste,
    producto_compra.pro_factura_unitaria,
    producto_compra.pro_diferencia_adicionada,
    producto_compra.pro_ID_ZGEN,
    producto_compra.id_proceso,
    producto_compra.created_at,
    producto_compra.updated_at,
    compra.compra_numero,
    compra.compra_amio,
    compra.compra_rut_enviar,
    compromisos.numero,
    procesos.id
    FROM
    producto_compra
    INNER JOIN compra ON producto_compra.pro_id_oc = compra.compra_id
    LEFT JOIN compromisos ON producto_compra.pro_id_cpp = compromisos.id
    INNER JOIN pro_asignar ON producto_compra.pro_id = pro_asignar.pro_id
    INNER JOIN procesos ON producto_compra.id_proceso = procesos.id
    where producto_compra.pro_estado_producto in(2,5)  and procesos.id='.$id);
  return $productos;

}
public function productosots(Request $request)
{
  $productos=DB::connection('ordenes_de_compras')->select('SELECT
    gestion_ordenes.compra.compra_numero,
    gestion_ordenes.compra.compra_amio,
    gestion_ordenes.producto_compra.pro_id,
    gestion_ordenes.producto_compra.pro_id_oc,
    gestion_ordenes.producto_compra.pro_nombre AS nombre,
    gestion_ordenes.producto_compra.pro_cantidad AS cantidad,
    gestion_ordenes.producto_compra.pro_descripcion,
    gestion_ordenes.producto_compra.pro_precio AS precio,
    gestion_ordenes.producto_compra.pro_id_aba,
    gestion_ordenes.producto_compra.pro_ordenados_por_numero,
    gestion_ordenes.producto_compra.pro_comprador,
    gestion_ordenes.producto_compra.pro_id_detalle_compra,
    gestion_ordenes.producto_compra.pro_oc_portal_id,
    gestion_ordenes.producto_compra.pro_id_cpp,
    gestion_ordenes.producto_compra.pro_estado_refrendacion,
    gestion_ordenes.producto_compra.pro_cuenta_sigfe,
    gestion_ordenes.producto_compra.pro_total,
    gestion_ordenes.producto_compra.pro_uindad_medida,
    gestion_ordenes.producto_compra.pro_nombre_sigfe,
    gestion_ordenes.producto_compra.pro_nombre_producto,
    gestion_ordenes.producto_compra.pro_sub_item_sigfe,
    gestion_ordenes.producto_compra.pro_estado_producto,
    gestion_ordenes.producto_compra.pro_estado_producto_anterior,
    gestion_ordenes.producto_compra.pro_costo_unitario_incluye_todo,
    gestion_ordenes.producto_compra.pro_justificacion,
    gestion_ordenes.producto_compra.pro_cc,
    gestion_ordenes.producto_compra.pro_oc_portal_individual,
    gestion_ordenes.producto_compra.pro_amio,
    gestion_ordenes.producto_compra.pro_convenio,
    gestion_ordenes.producto_compra.pro_cantidad_solicitud,
    gestion_ordenes.producto_compra.pro_precio_unitario,
    gestion_ordenes.producto_compra.pro_cantidad_unitario,
    gestion_ordenes.producto_compra.pro_costo_unitario_producto_sin_ajuste,
    gestion_ordenes.producto_compra.pro_costo_unitario_ajuste,
    gestion_ordenes.producto_compra.pro_factura_unitaria,
    gestion_ordenes.producto_compra.pro_diferencia_adicionada,
    gestion_ordenes.producto_compra.pro_ID_ZGEN,
    gestion_ordenes.producto_compra.id_proceso,
    gestion_ordenes.producto_compra.sigfe_item,
    gestion_ordenes.producto_compra.created_at,
    gestion_ordenes.producto_compra.updated_at,
    gestion_ordenes.compromisos.numero,
    gestion_ordenes.compromisos.total_neto,
    gestion_ordenes.compromisos.iva,
    gestion_ordenes.compromisos.bruto,
    gestion_ordenes.compromisos.total,
    gestion_ordenes.compromisos.descuento,
    gestion_ordenes.compromisos.despacho,
    gestion_ordenes.compromisos.impuesto,
    prespuestos.centrosdecostos.nombre AS cc_nombre,
    gestion_ordenes.cuentas_sigfe.nombre AS nombre_sigfe,
    gestion_ordenes.estado_cpp.nombre AS cpp_estado,
    gestion_ordenes.estado_cpp.id AS cpp_estado_id
    FROM
    gestion_ordenes.producto_compra
    INNER JOIN gestion_ordenes.compra ON gestion_ordenes.producto_compra.pro_id_oc = gestion_ordenes.compra.compra_id
    INNER JOIN gestion_ordenes.compromisos ON gestion_ordenes.producto_compra.pro_id_cpp = gestion_ordenes.compromisos.id
    INNER JOIN prespuestos.centrosdecostos ON gestion_ordenes.producto_compra.pro_cc = prespuestos.centrosdecostos.id
    INNER JOIN gestion_ordenes.cuentas_sigfe ON gestion_ordenes.producto_compra.pro_cuenta_sigfe = gestion_ordenes.cuentas_sigfe.sigfe_id
    INNER JOIN gestion_ordenes.estado_cpp ON gestion_ordenes.compromisos.estado = gestion_ordenes.estado_cpp.id
    WHERE
    gestion_ordenes.compra.compra_numero='.$request->numero.' and pro_estado_producto != 9 and gestion_ordenes.compra.compra_amio='.$request->year.'
    ORDER BY
    gestion_ordenes.producto_compra.pro_ordenados_por_numero ASC');

  return $productos;

}

public function show($id)
{
 $productos=DB::connection('ordenes_de_compras')->select('
  SELECT
    (CASE WHEN ( gestion_ordenes.producto_compra.pro_comprador IS NULL ) THEN (0) ELSE (1) END ) AS crud,
  gestion_ordenes.producto_compra.pro_id,
  gestion_ordenes.producto_compra.pro_id_oc,
  gestion_ordenes.producto_compra.pro_nombre,
  gestion_ordenes.producto_compra.pro_cantidad,
  gestion_ordenes.producto_compra.pro_descripcion,
  gestion_ordenes.producto_compra.pro_precio,
  gestion_ordenes.producto_compra.pro_id_aba,
  gestion_ordenes.producto_compra.pro_ordenados_por_numero,
  gestion_ordenes.producto_compra.pro_comprador,
  gestion_ordenes.producto_compra.pro_id_detalle_compra,
  gestion_ordenes.producto_compra.pro_oc_portal_id,
  gestion_ordenes.producto_compra.pro_id_cpp,
  gestion_ordenes.producto_compra.pro_estado_refrendacion,
  gestion_ordenes.producto_compra.pro_cuenta_sigfe,
  gestion_ordenes.producto_compra.pro_total,
  gestion_ordenes.producto_compra.pro_uindad_medida,
  gestion_ordenes.producto_compra.pro_nombre_sigfe,
  gestion_ordenes.producto_compra.pro_nombre_producto,
  gestion_ordenes.producto_compra.pro_sub_item_sigfe,
  gestion_ordenes.producto_compra.pro_estado_producto,
  gestion_ordenes.producto_compra.pro_estado_producto_anterior,
  gestion_ordenes.producto_compra.pro_costo_unitario_incluye_todo,
  gestion_ordenes.producto_compra.pro_justificacion,
  gestion_ordenes.producto_compra.pro_cc,
  gestion_ordenes.producto_compra.pro_oc_portal_individual,
  gestion_ordenes.producto_compra.pro_amio,
  gestion_ordenes.producto_compra.pro_convenio,
  gestion_ordenes.producto_compra.pro_cantidad_solicitud,
  gestion_ordenes.producto_compra.pro_precio_unitario,
  gestion_ordenes.producto_compra.pro_cantidad_unitario,
  gestion_ordenes.producto_compra.pro_costo_unitario_producto_sin_ajuste,
  gestion_ordenes.producto_compra.pro_costo_unitario_ajuste,
  gestion_ordenes.producto_compra.pro_factura_unitaria,
  gestion_ordenes.producto_compra.pro_diferencia_adicionada,
  gestion_ordenes.producto_compra.pro_ID_ZGEN,
  gestion_ordenes.producto_compra.id_proceso,
  gestion_ordenes.producto_compra.created_at,
  gestion_ordenes.producto_compra.updated_at,
  gestion_ordenes.compra.compra_numero,
  gestion_ordenes.estados_ot.estado_nombre,
  ssalud.persona.per_nombre,
  gestion_ordenes.funcionarios_compra.per_nombre AS nombre_comprador,
  gestion_ordenes.estado_producto.created_at,
  gestion_ordenes.estado_producto.nombre AS estado_producto,
  gestion_ordenes.producto_compra.pro_observacion
  FROM
  gestion_ordenes.producto_compra
  INNER JOIN gestion_ordenes.compra ON gestion_ordenes.producto_compra.pro_id_oc = gestion_ordenes.compra.compra_id
  INNER JOIN gestion_ordenes.estados_ot ON gestion_ordenes.compra.compra_estado = gestion_ordenes.estados_ot.estado_id
  LEFT JOIN ssalud.persona ON gestion_ordenes.producto_compra.pro_comprador = ssalud.persona.per_rut COLLATE utf8_general_ci 
  LEFT JOIN gestion_ordenes.funcionarios_compra ON gestion_ordenes.producto_compra.pro_comprador = gestion_ordenes.funcionarios_compra.id
  INNER JOIN gestion_ordenes.estado_producto ON gestion_ordenes.producto_compra.pro_estado_producto = gestion_ordenes.estado_producto.id
  WHERE
  gestion_ordenes.producto_compra.pro_id_oc ='.$id.' 
  ORDER BY
  gestion_ordenes.producto_compra.pro_ordenados_por_numero ASC');
 return $productos;
}
public function cantidadproductosot($id){

  $productos=DB::connection('ordenes_de_compras')->select('SELECT
    Count(producto_compra.pro_id) AS TOTAL
    FROM
    producto_compra
    WHERE producto_compra.pro_id_oc='.$id.'  AND producto_compra.pro_estado_producto=2');

  return $productos;

}
public function productos_cpp($id)
{
  $productos=DB::connection('ordenes_de_compras')->select('SELECT
    gestion_ordenes.compra.compra_numero as oc,
    gestion_ordenes.compra.compra_amio,
    gestion_ordenes.producto_compra.pro_id AS id_producto,
    gestion_ordenes.producto_compra.pro_id_oc,
    gestion_ordenes.producto_compra.pro_nombre AS nombre,
    gestion_ordenes.producto_compra.pro_cantidad AS cantidad,
    gestion_ordenes.producto_compra.pro_descripcion,
    gestion_ordenes.producto_compra.pro_precio AS precio,
    gestion_ordenes.producto_compra.pro_id_aba,
    gestion_ordenes.producto_compra.pro_ordenados_por_numero,
    gestion_ordenes.producto_compra.pro_comprador,
    gestion_ordenes.producto_compra.pro_id_detalle_compra,
    gestion_ordenes.producto_compra.pro_oc_portal_id,
    gestion_ordenes.producto_compra.pro_id_cpp,
    gestion_ordenes.producto_compra.pro_estado_refrendacion,
    gestion_ordenes.producto_compra.pro_cuenta_sigfe as cuenta_sigfe,
    gestion_ordenes.producto_compra.pro_total as t_neto,
    gestion_ordenes.producto_compra.pro_uindad_medida,   
    gestion_ordenes.producto_compra.pro_nombre_producto,
    gestion_ordenes.producto_compra.pro_sub_item_sigfe as sub_item_sigfe,
    gestion_ordenes.producto_compra.pro_estado_producto,
    gestion_ordenes.producto_compra.pro_estado_producto_anterior,
    gestion_ordenes.producto_compra.pro_costo_unitario_incluye_todo,
    gestion_ordenes.producto_compra.pro_justificacion,
    gestion_ordenes.producto_compra.pro_cc,
    gestion_ordenes.producto_compra.pro_oc_portal_individual,
    gestion_ordenes.producto_compra.pro_amio,
    gestion_ordenes.producto_compra.pro_convenio,
    gestion_ordenes.producto_compra.pro_cantidad_solicitud,
    gestion_ordenes.producto_compra.pro_precio_unitario as precio_unitario,
    gestion_ordenes.producto_compra.pro_cantidad_unitario as cantidad_unitario,
    gestion_ordenes.producto_compra.pro_costo_unitario_producto_sin_ajuste,
    gestion_ordenes.producto_compra.pro_costo_unitario_ajuste,
    gestion_ordenes.producto_compra.pro_factura_unitaria,
    gestion_ordenes.producto_compra.pro_diferencia_adicionada,
    gestion_ordenes.producto_compra.pro_ID_ZGEN,
    gestion_ordenes.producto_compra.id_proceso,
    gestion_ordenes.producto_compra.sigfe_item,
    gestion_ordenes.producto_compra.created_at,
    gestion_ordenes.producto_compra.updated_at,
    gestion_ordenes.compromisos.numero,
    gestion_ordenes.compromisos.total_neto,
    gestion_ordenes.compromisos.iva,
    gestion_ordenes.compromisos.bruto,
    gestion_ordenes.compromisos.total,
    gestion_ordenes.compromisos.descuento,
    gestion_ordenes.compromisos.despacho,
    gestion_ordenes.compromisos.impuesto,
    prespuestos.centrosdecostos.nombre AS cc,
    gestion_ordenes.cuentas_sigfe.nombre AS nombre_sigfe,
    gestion_ordenes.estado_cpp.nombre AS cpp_estado,
    gestion_ordenes.estado_cpp.id AS cpp_estado_id,
    prespuestos.centrosdecostos.cr
    FROM
    gestion_ordenes.producto_compra
    LEFT JOIN gestion_ordenes.compra ON gestion_ordenes.producto_compra.pro_id_oc = gestion_ordenes.compra.compra_id
    INNER JOIN gestion_ordenes.compromisos ON gestion_ordenes.producto_compra.pro_id_cpp = gestion_ordenes.compromisos.id
    LEFT JOIN prespuestos.centrosdecostos ON gestion_ordenes.producto_compra.pro_cc = prespuestos.centrosdecostos.id
    LEFT JOIN gestion_ordenes.cuentas_sigfe ON gestion_ordenes.producto_compra.pro_cuenta_sigfe = gestion_ordenes.cuentas_sigfe.sigfe_id
    INNER JOIN gestion_ordenes.estado_cpp ON gestion_ordenes.compromisos.estado = gestion_ordenes.estado_cpp.id
    WHERE
    gestion_ordenes.compromisos.id='.$id);

 // $productos= (array) json_decode($productos);

  for ($i=0; $i <count($productos) ; $i++) { 
    $productos[$i]->id_index=$i;
    // code...
  }
  return $productos;

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cantidad_productos($id)
    {
     $p=Productos::where('id_proceso',$id)->get()->count();
     return $p;
   }
   public function edit($id)
   {

   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update2(Request $request)
    {
     Productos::where('pro_id',$request->pro_id)->update(['pro_estado'=>$request->pro_descripcion]);

   }
   public function update(Request $request, $id)
   {
     Productos::where('pro_id',$id)->update($request->except('_method', '_token'));
     return $id;
   }
   public function updateporot(Request $request,$id)
   {
     Productos::where('pro_id_oc',$id)->update($request->except('_method', '_token'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productos::where('pro_id',$id)->delete();
    }
  }
