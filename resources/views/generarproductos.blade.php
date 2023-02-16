
@extends('layouts.app')
@section('content')
<add-productos :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></add-productos>
@endsection


