@extends('layouts.app')
@section('content')
<bienvenida-home :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></bienvenida-home>
@endsection