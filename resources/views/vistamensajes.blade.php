@extends('layouts.app')
@section('content')


<listar-mensajes :id_session="{{ json_encode(run_session())}}" :id_mensaje="{{json_encode($id_noti)}}"></listar-mensajes>
@endsection