@extends('layouts.app')
@section('content')
<asignar-ot :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></asignar-ot>
@endsection