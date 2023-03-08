<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

@push('script-fisrt')
@endpush

@section('content')
@if($permition == 'admin' || $permition == 'cliente' || $permition == 'vendedor')
    <section class="content justify-content-md-center">
        <div class="row justify-content-md-center">
            <div class="col-md-8 justify-content-md-center">
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Contratar Plano</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body">
                        @if(isset($msg) && $msg=='Usuario Criado')
                            <div class="alert alert-success" role="alert">
                                {{$msg}}    
                            </div>
                        @endif

                        @if(isset($msg) && $msg!='Usuario Criado')
                            <div class="alert alert-danger" role="alert">
                                {{$msg}}    
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="\quotas\hiring" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="user" name="user" value="{{$user->id}}" >
                            <input type="hidden" class="form-control" id="seller" name="seller" value="{{Auth::user()->id}}" >
                            <label>Planos</label>
                            <select class="form-control" id="quota" name="quota">
                                @foreach($quotas as $quota)
                                <option value="{{$quota->id}}">Plano: {{$quota->description}}, Valor do Plano: R$ {{ number_format($quota->total_price,2,",",".") }}; Desconto: R$ {{ number_format($quota->customer_limit,2,",",".") }}; Inicio: {{ date('d/m/Y', strtotime($quota->initial_date)) }}, Fim: {{ date('d/m/Y', strtotime($quota->final_date)) }}.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    
@endif
@endsection