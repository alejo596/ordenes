<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adjuntos;
use App\Year;
use App\AdjuntosOts;
use Illuminate\Support\Facades\Storage;

class AdjuntoController extends Controller
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
        $fecha=date('Y-m-d');
        $mes=date('m');
        $fecha2 = date_create();
        $year=Year::where('estado',1)->first();
        $nombre = $request->file->getClientOriginalName();
        $extension=explode('.',$nombre);
       
        \Storage::put('/public/'.$year->year.'/'.$mes.'/'.$request->oc.'/'.$request->id.'/'.$nombre,\File::get($request->file));
        $url_storage='/public/'.$year->year.'/'.$mes.'/'.$request->oc.'/'.$request->id.'/'.$nombre;
        $id=$request->id;
        $timestamp=date_timestamp_get($fecha2);
        $randomkey=rand();
        $key=base64_encode($timestamp.$randomkey.$request->id);
         $nombre_adjunto=$key.'.'.$extension[1];
        $adjunto=new Adjuntos();
        $adjunto->adj_id_solicitud=$request->oc;
        $adjunto->adj_adjuntado="V";
        $adjunto->adj_nombre=$nombre_adjunto;
        $adjunto->adj_fecha= $fecha;
        $adjunto->adj_producto_id=$request->id;
        $adjunto->save();

        $adj= new AdjuntosOts();
        $adj->nombre=$nombre;
        $adj->url=$url_storage;
        $adj->oc=$request->oc;
        $adj->id_producto=$request->id;
        $adj->save();


        // $storagePath  = Storage::disk('local')->get($url_storage);

        // $carpeta_sist = 'OT/ADJOT';
        // $ruta  = $carpeta_sist.'/'.$year->year.'/'.$mes;
        
        // $fileRemote = $ruta.'/'.$nombre_adjunto;
        // $mode = 'FTP_BINARY';        //Hacemos el upload
          
        
        // $ftp_l=Storage::disk('ftp')->put($fileRemote,$storagePath);
       
        // if($ftp_l == false){
        //    return('Operación rechazada');
        // }else{
        //    return('Operación realizada con éxito');
        // }
        //Detenemos la funcion con un mensajes



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adjuntos=Adjuntos::where('adj_id_solicitud',$id)->get();
        return $adjuntos;
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
