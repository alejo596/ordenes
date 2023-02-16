@extends('layouts.app')
@section('content')
<r-fondo-component :id_session="{{ json_encode(run_session())}}"></r-fondo-component>
@endsection