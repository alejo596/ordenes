<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Conformidad;

class ConformidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = array();
        $sql=DB::connection('ordenes_de_compras')->select("SELECT
            facturacionv2.documentos.ocportal as oc,
            gestion_ordenes.proveedores.nombre as proveedor,
            facturacionv2.documentos.id AS idFac,
            bodega_inventario_new.recepcion_bodega_new.recep_id AS idRecep,
            bodega_inventario_new.recepcion_bodega_new.recep_num AS numRecep,
            bodega_inventario_new.recepcion_bodega_new.recep_num AS anioRecp,
            gestion_ordenes.compromisos.id AS id_cpp,
            gestion_ordenes.compromisos.numero AS numero,
            gestion_ordenes.compromisos.year AS year,
            facturacionv2.documentos.chk_oc,
            bodega_inventario_new.adjuntos_new.adj_nombre,
            YEAR (
                bodega_inventario_new.adjuntos_new.adj_fecha
                ) AS anio,
            MONTH (
                bodega_inventario_new.adjuntos_new.adj_fecha
                ) AS mes,
            facturacionv2.documentos.numero AS factura,
            facturacionv2.documentos.link as pdffactura,
            bodega_inventario_new.recepcion_bodega_new.recep_doc_tipo
            FROM
            facturacionv2.documentos
            LEFT JOIN gestion_ordenes.proveedores ON facturacionv2.documentos.proveedor_rut = gestion_ordenes.proveedores.run
            LEFT JOIN facturacionv2.documento_has_recepcion ON facturacionv2.documentos.id =facturacionv2.documento_has_recepcion.id_documento
            LEFT JOIN bodega_inventario_new.recepcion_bodega_new ON facturacionv2.documento_has_recepcion.id_recepcion_bodega = bodega_inventario_new.recepcion_bodega_new.recep_id
            LEFT JOIN gestion_ordenes.compromisos ON bodega_inventario_new.recepcion_bodega_new.recep_cpp = gestion_ordenes.compromisos.id
            LEFT JOIN bodega_inventario_new.adjuntos_new ON bodega_inventario_new.recepcion_bodega_new.recep_id = bodega_inventario_new.adjuntos_new.adj_id_registro
            AND bodega_inventario_new.adjuntos_new.adj_adjuntado = 'V'
            WHERE
            facturacionv2.documentos.docto_estado_id = 9");
        $json= json_encode($sql);
        $sql = json_decode($json, true);
     

        for ($i=0; $i < count($sql); $i++) { 
            
            $idDoc = $sql[$i]['idFac'];
         
            if(isset($documentos[$idDoc])){
           }else{
            $documentos[$idDoc]['idFac'] = $sql[$i]['idFac'];
            $documentos[$idDoc]['oc'] = $sql[$i]['oc'];
            $documentos[$idDoc]['proveedor'] = $sql[$i]['proveedor'];
            $documentos[$idDoc]['numero'] = $sql[$i]['numero'];
            $documentos[$idDoc]['pdffactura'] = $sql[$i]['pdffactura'];
            $documentos[$idDoc]['chk_oc'] = $sql[$i]['chk_oc'];
            $documentos[$idDoc]['recepciones'] = array();
            $documentos[$idDoc]['cpp'] = array();
            $documentos[$idDoc]['adjuntos'] = array();
           }
            if ($sql[$i]['idRecep'] != '') {
                array_push($documentos[$idDoc]['recepciones'],$sql[$i]['idRecep']);
            }
            if ($sql[$i]['id_cpp'] != '') {
                array_push($documentos[$idDoc]['cpp'],$sql[$i]['id_cpp']);          
            }

        }
        $documentos = array_values($documentos);

        for($i = 0; $i < count($documentos); $i++){
            $documentos[$i]['recepciones'] = array_values(array_unique($documentos[$i]['recepciones']));
            $documentos[$i]['cpp'] = array_values(array_unique($documentos[$i]['cpp']));
        }

        return   $documentos;

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
        //
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
