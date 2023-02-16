
@extends('layouts.app')
@section('content')
<add-cuentas :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></add-cuentas>
@endsection
