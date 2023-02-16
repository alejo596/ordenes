@extends('layouts.visorpdfcpp')
@section('content')
<cpp-pdf :cod="{{json_encode($cod)}}"> </cpp-pdf>


@endsection