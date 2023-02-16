<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facturacion;
use App\Documentos;
use Illuminate\Support\Facades\DB;

class FacturacionController extends Controller
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

       $d=Documentos::where('numero',$request->numero)
       ->where('proveedor_rut','=',$request->run)
       ->where('docto_tipo_id',$request->tipo)
       ->first();

       if(!$d){
        return 0;

       }else{
          return $d;
       }

     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function showfacturacion($id)
    {
     $sql=DB::connection('facturacion')->select("SELECT documentos.id AS id_factura,Nota.id AS id_nota_credito,Nota.numero AS num_nota_credito,Nota.link 
        FROM documentos INNER JOIN factura_has_documento AS factura ON documentos.id=factura.id_factura 
        INNER JOIN documentos AS Nota ON factura.id_documento=Nota.id 
        AND Nota.docto_tipo_id = 4 
        WHERE documentos.docto_estado_id = 9 and documentos.id=".$id);
        return $sql;
    }
    public function show($id)
    {
       $f=Facturacion::select('facturacionv2.documento_has_recepcion.id',
        'facturacionv2.documento_has_recepcion.id_documento',
        'facturacionv2.documento_has_recepcion.id_recepcion_bodega',
        'facturacionv2.documento_has_recepcion.created_at',
        'facturacionv2.documento_has_recepcion.id_mini_recepcion',
        'facturacionv2.documento_has_recepcion.responsable',
        'bodega_inventario.recepcion_bodega.num_recepcion',
        'bodega_inventario.recepcion_bodega.id_recepcion')
       ->join('bodega_inventario.recepcion_bodega','facturacionv2.documento_has_recepcion.id_recepcion_bodega','=','bodega_inventario.recepcion_bodega.id_recepcion')
       ->where('bodega_inventario.recepcion_bodega.id_recepcion',$id)
       ->get();

       return $f;

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
        Documentos::find($id)->update($request->except('_method', '_token'));
        
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
