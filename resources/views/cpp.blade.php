@extends('layouts.app')
@section('content')
<crear-cpp :id_session="{{ json_encode(run_session())}}" ></crear-cpp>
@endsection