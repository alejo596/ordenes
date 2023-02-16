@extends('layouts.app')
@section('content')
<example-component :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></example-component>
@endsection