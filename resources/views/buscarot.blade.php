@extends('layouts.app')
@section('content')
<buscar-ot :id_session="{{ json_encode(run_session())}}" ></buscar-ot>
@endsection