@extends('layouts.app')
@section('content')
<modificar-productos :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></modificar-productos>

@endsection