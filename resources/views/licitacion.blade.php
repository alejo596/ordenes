@extends('layouts.app')
@section('content')
<crear-licitacion :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></crear-licitacion>
@endsection