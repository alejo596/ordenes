@extends('layouts.app')
@section('content')
<viaticos-component :id_session="{{ json_encode(run_session())}}"></viaticos-component>
@endsection