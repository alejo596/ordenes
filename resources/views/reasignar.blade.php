
@extends('layouts.app')
@section('content')
<reasignar-ot :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></reasignar-ot>

@endsection