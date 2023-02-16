<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificaciones;

class NotificacionesController extends Controller
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

        $notas='Se '.$request->accion.' la ot N°'.$request->ot.' motivo:'. $request->observacion;
        $n=new Notificaciones();
        $n->estado=$request->estado;
        $n->usuario=$request->usuario;
        $n->observacion=$notas;
        $n->save();

        return $n->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show3($id)
    {
        $n=Notificaciones::select('ssalud.persona.per_nombre',
           'gestion_ordenes.notificaciones.id',
           'gestion_ordenes.notificaciones.estado',
           'gestion_ordenes.notificaciones.usuario',
           'gestion_ordenes.notificaciones.observacion',
           'gestion_ordenes.notificaciones.created_at',
           'gestion_ordenes.notificaciones.updated_at',
           'gestion_ordenes.estado_mensajes.nombre')
        ->join('ssalud.persona','gestion_ordenes.notificaciones.usuario','=','ssalud.persona.per_rut')
        ->join('gestion_ordenes.estado_mensajes','gestion_ordenes.notificaciones.estado','=','gestion_ordenes.estado_mensajes.id')
        ->where('usuario',$id)->get();
        return $n;

        
    }
    public function show2($id)
    {
        $n=Notificaciones::find($id)->update(['estado'=>2]);

        return view('vistamensajes')->with('id_noti',$id);
    }
    public function show($id)
    {
        $n=Notificaciones::where('id',$id)->first();

        return $n;

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
