@extends('layouts.app')
@section('content')
<lista-ordenes :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></lista-ordenes>

@endsection