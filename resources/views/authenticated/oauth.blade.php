@extends('layouts.master')

@section('content')
    <div id="app">
        <authorized-clients></authorized-clients>
        <clients></clients>
        <personal-access-token></personal-access-token>
    </div>
@endsection
