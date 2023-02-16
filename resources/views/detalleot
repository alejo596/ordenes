@extends('layouts.app')
@section('content')

@if(isset($xcf) == false)
@php
 header("Location: " . URL::to('/'), true, 302);
        exit();
        @endphp
@else
<time-line :id="{{json_encode($xcf)}}" :cod="{{json_encode($cod)}}"></time-line>
@endif

@endsection