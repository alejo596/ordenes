<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdjuntosDocumentos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdjuntosDocumentosController extends Controller
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

    public function store2(Request $request)
    {
       $a=new AdjuntosDocumentos();
       $a->nombre=$request->nombre;
       $a->url=$request->url;
       $a->tipo=$request->tipo;
       $a->numero=$request->id;
       $a->save();
       return $a->id;

   }    
   public function store(Request $request)
   {
    $nombre = $request->file->getClientOriginalName();
    $extension=explode('.',$nombre);
    $mes=date('m');
    \Storage::put('/public/'.$request->year.'/'.$mes.'/'.$request->tipo.'/'.$request->numero.'/'.$nombre,\File::get($request->file));
    $url_storage='/public/'.$request->year.'/'.$mes.'/'.$request->tipo.'/'.$request->numero.'/'.$nombre;

    $a=new AdjuntosDocumentos();
    $a->nombre=$nombre;
    $a->url=$url_storage;
    $a->tipo=$request->tipo;
    $a->numero=$request->id;
    $a->save();
    return $a->id;
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $a=AdjuntosDocumentos::select(
         DB::raw('1 as crud'),
         'adjuntos_documentos.id',
         'adjuntos_documentos.nombre',
         'adjuntos_documentos.url',
         'adjuntos_documentos.tipo',
         'adjuntos_documentos.created_at',
         'adjuntos_documentos.updated_at',
         'adjuntos_documentos.numero',
         'adjuntos_documentos.idproducto',
         'producto_compra.pro_id',
         'producto_compra.pro_precio',
         'producto_compra.pro_sub_item_sigfe',
         'producto_compra.pro_nombre_sigfe',
         'producto_compra.pro_total',
         'producto_compra.pro_cuenta_sigfe')
        ->leftjoin('producto_compra','adjuntos_documentos.idproducto','=','producto_compra.pro_id')
        ->where('numero',$id)->get();
        return $a;
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
        AdjuntosDocumentos::where('numero',$id)->update($request->except('_method', '_token'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url=AdjuntosDocumentos::find($id,['url']);
        Storage::disk('public')->delete($url->url);
        AdjuntosDocumentos::find($id)->delete();
    }
}
