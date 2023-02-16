@extends('layouts.app')
@section('content')
<listar-quimico :id_session="{{ json_encode(run_session())}}" ></listar-quimico>
@endsection