@extends('layouts.app')
@section('content')
<generar-ordenes-component :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></generar-ordenes-component>
@endsection