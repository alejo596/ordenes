@extends('layouts.app')
@section('content')
<gestion-compra :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></gestion-compra>
@endsection