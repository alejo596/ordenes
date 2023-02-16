@extends('layouts.visor')
@section('content')

<visor-pdf :cod="{{json_encode($cod)}}" :sis="{{$sis}}"></visor-pdf>
@endsection