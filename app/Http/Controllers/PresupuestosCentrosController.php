<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Presupuestos;
use App\PresupuestoAnualCC;
use App\Year;
use App\TotalGastadoCC; 


class PresupuestosCentrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function centros_de_costo_total_ejecutado_22(Request $request)
    {
        $year=Year::where('estado',1)->first();
        
        $gastado=DB::connection('mysql2')
        ->select('SELECT
            Sum(presupuesto.gasto_presupuestario.gasto_pre_monto) AS GASTO_ejecutado,
            presupuesto.gasto_presupuestario.gasto_pre_id_cc AS id_cc,
            LEFT(gasto_presupuestario.gasto_pre_sub_sigfe, 2) AS sigfe
            FROM
            presupuesto.gasto_presupuestario
            INNER JOIN gestion_ordenes.producto_compra ON presupuesto.gasto_presupuestario.gasto_pre_id_producto = gestion_ordenes.producto_compra.pro_id
            INNER JOIN gestion_ordenes.cpp ON gestion_ordenes.producto_compra.pro_id_cpp = gestion_ordenes.cpp.cpp_id
            WHERE
            presupuesto.gasto_presupuestario.gasto_pre_id_cc = '.$request->cc.' AND
            presupuesto.gasto_presupuestario.gasto_pre_amio = '.intval($year->year).' AND
            presupuesto.gasto_presupuestario.gasto_pre_estado = 2 AND
            presupuesto.gasto_presupuestario.gasto_pre_convenio IS NULL AND
            LEFT(gasto_presupuestario.gasto_pre_sub_sigfe, 2) IN ('.$request->sigfe.') AND
            gestion_ordenes.producto_compra.pro_estado_producto IN (13)
            GROUP BY
            gasto_presupuestario.gasto_pre_id_cc,
            LEFT(gasto_presupuestario.gasto_pre_sub_sigfe, 2)
            ORDER BY
            id_cc ASC');
 
        if(empty($gastado))
        {
            $ejecutado1=0;
        }else{

            foreach ($gastado as $key) {
             $ejecutado1=$key->GASTO_ejecutado;

         }

     }

     return $ejecutado1;




 }
 public function centros_de_costo_total_gastado_sin_refrendar(Request $request)
 {
   $year=Year::where('estado',1)->first();
   $gastado=DB::connection('ordenes_de_compras')
   ->select('SELECT
    Sum(if(producto_compra.pro_costo_unitario_incluye_todo is NULL,producto_compra.pro_total,producto_compra.pro_costo_unitario_incluye_todo)) as total_ot
    FROM
    compra
    INNER JOIN producto_compra ON compra.compra_id = producto_compra.pro_id_oc
    WHERE
    compra.compra_cc = '.$request->cc.' AND
    producto_compra.pro_estado_refrendacion = 1 AND
    producto_compra.pro_convenio IN (NULL,0) AND
    compra.compra_estado NOT IN (1, 8) AND
    compra.compra_amio = '.intval($year->year).' AND
    producto_compra.pro_estado_producto < 6');
 
 $totalcentro=$gastado[0]->total_ot;
 if( $gastado[0]->total_ot == null){
     $totalcentro=0;
 }


 return $totalcentro;
}
public function centros_de_costo_presupuesto_anual(Request $request)
{

    $presu=new PresupuestosCentrosController();

    $year=Year::where('estado',1)->first();

    $centros=PresupuestoAnualCC::where('presu_cc_amio',$year->year)
    ->where('presu_cc_id_cc',$request->cc)
    ->sum('presu_cc_monto');
    $total_gastado=$presu->centros_de_costo_total_gastado($request);

    $saldoc=$centros-$total_gastado;

    $ejecut=$presu->centros_de_costo_total_ejecutado_22($request);
    $srefrendar=$presu->centros_de_costo_total_gastado_sin_refrendar($request);
    $pre_cr= $presu->presupuestocr($request);



    $saldoaa=intval($saldoc)-intval($srefrendar);
    $saldo=intval($centros) -(intval($srefrendar)+intval($total_gastado));
    $gastadoot=$presu->totalgastado($request);

    $resultado = array('presupuestocc'=>intval($centros),'g_refrendado'=>$total_gastado,'saldo_cc'=> $saldoc,'saldo_actual'=>$saldoaa,'g_ejecutado'=>$ejecut,'sinrefrendar'=>intval($srefrendar),'saldo_ot'=>$saldoaa,'saldo'=>$saldo,'gastadoot'=>$gastadoot,'presucr'=>$pre_cr);
    return $resultado;


}
public function centros_de_costo_total_gastado(Request $request)
{
    $year=Year::where('estado',1)->first();

    $gastado=DB::connection('mysql2')
    ->select('SELECT
        Sum(gasto_presupuestario.gasto_pre_monto) AS total
        FROM
        gasto_presupuestario
        WHERE
        gasto_presupuestario.gasto_pre_id_cc ='.$request->cc.' AND      
        LEFT(gasto_presupuestario.gasto_pre_sub_sigfe, 2) = '.$request->sigfe.' AND                      
        gasto_presupuestario.gasto_pre_amio = '.intval($year->year).' AND
        gasto_presupuestario.gasto_pre_estado = 2 AND
        gasto_presupuestario.gasto_pre_convenio IS NULL');

    

    
        $totalcentro=$gastado[0]->total;
    
    if( $gastado[0]->total == null){
     $totalcentro=0;
 }



 return  $totalcentro;
}

public function buscarsigfes(Request $request)
{
  $year=Year::where('estado',1)->first();
  $sigfe=DB::connection('mysql2')
  ->select('SELECT DISTINCT

    presupuesto_cc.presu_cc_familia_sigfe AS FAMILIA_SIG

    FROM
    centro_de_responsabilidad
    INNER JOIN centro_de_costo ON centro_de_responsabilidad.cr_id = centro_de_costo.cc_cr_id
    AND centro_de_costo.cc_eliminado IS NULL
    INNER JOIN presupuesto_cc ON centro_de_costo.cc_id = presupuesto_cc.presu_cc_id_cc
    AND presupuesto_cc.presu_cc_amio ='.intval($year->year).'
    WHERE
    centro_de_responsabilidad.cr_id ='.$request->cr.'
    GROUP BY
    centro_de_responsabilidad.cr_nombre,
    centro_de_costo.cc_nombre,
    presupuesto_cc.presu_cc_familia_sigfe
    ORDER BY
    centro_de_responsabilidad.cr_id ASC,
    centro_de_costo.cc_id ASC');  
  return  $sigfe;
}

public function totalgastado(Request $request)
{
       $year=Year::where('estado',1)->first();
        $gasto=TotalGastadoCC::where('gasto_pre_id_cr',$request->cr)
        ->where('gasto_pre_sub_sigfe_familia','=',$request->sigfe)
        ->where('gasto_pre_amio','=',intval($year->year))
        ->where('gasto_pre_estado','=',2)
        ->whereNull('gasto_pre_convenio')
        ->sum('gasto_pre_monto');
        return $gasto;

}
public function presupuestocr(Request $request)
{
     $year=Year::where('estado',1)->first();
     $presu=PresupuestoAnualCC::where('presu_cc_amio',intval($year->year))
        ->where('presu_cc_id_cr',$request->cr)
        ->sum('presu_cc_monto');

        return $presu;

}



}
