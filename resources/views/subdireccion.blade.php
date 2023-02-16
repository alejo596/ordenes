@extends('layouts.app')
@section('content')

<subdireccion-component :id_session="{{ json_encode(run_session())}}" :cr="{{$codigo}}" :sub_cc={{$cc_sub}}></subdireccion-component>
@endsection