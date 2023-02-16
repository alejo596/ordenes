@extends('layouts.app')
@section('content')
<listar-conformidad :id_session="{{ json_encode(run_session())}}" :nombre="{{json_encode(current_user())}}"></listar-conformidad>

@endsection