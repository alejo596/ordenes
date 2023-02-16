@extends('layouts.visorot')
@section('content')


<pdf-vista  :id_session="{{ json_encode(run_session())}}" :cod="{{json_encode($cod)}}"></pdf-vista>

@endsection