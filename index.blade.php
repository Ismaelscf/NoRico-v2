@extends('adminlte::page')

@section('title', 'Lojas')

@section('content_header')
    <h1 class="m-0 text-dark">Lojas</h1>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12 col-sm-12">
            @include('stores.create')
        </div>

        <div class="col-md-12 col-sm-12">
            @include('stores.storeList')
        </div>
    </div>

@stop
