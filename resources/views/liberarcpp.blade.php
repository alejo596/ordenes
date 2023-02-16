@extends('layouts.app')
@section('content')
<liberar-cpp :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></liberaer-cpp>
@endsection