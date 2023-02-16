@extends('layouts.app')
@section('content')

<listar-procesos :id_session="{{ json_encode(run_session())}}" ></listar-procesos>
@endsection