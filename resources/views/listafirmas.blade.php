@extends('layouts.app')
@section('content')
<listar-firmas :id_session="{{ json_encode(run_session())}}" ></listar-firmas>
@endsection