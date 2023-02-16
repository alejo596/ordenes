@extends('layouts.app')
@section('content')
<s-fondo-component :id_session="{{ json_encode(run_session())}}"></s-fondo-component>
@endsection