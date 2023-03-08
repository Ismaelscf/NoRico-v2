<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    
    <script>
        console.log('teste');
        $(document).ready(function() {
            $('.select2').select2({
                // width: 'resolve',
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@section('content')
@if($permition == 'admin')
    <section class="content">
        <div class="row">

            @if(isset($result) && $result == 'Error')
                <div class="alert alert-danger" role="alert">
                    Erro, A data final não pode anteceder a data inicial. Sorteio Não cadastrado
                </div>
            @elseif(isset($result) && $result != null)
                <div class="alert alert-success" role="alert">
                    {{ $result }}
                </div>
            @endif
            

            <div class="card card-gray-dark">

                <div class="card-header ui-sortable-handle">
                    <h3 class="card-title">Detalhe sorteio</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            
                <div class="card-body">
                    <form action="{{ route('sort.editPost'); }}" enctype="multipart/form-data" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="id" id="id" value="{{ $sort->id }}">
                    <input type="hidden" name="active" id="active" value="{{ $sort->active }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="image">Capa</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            @if (isset($sort->image))
                                <img class="img-circle" width="200" src="{{ asset($sort->image) }}" alt="Capa do sorteio">
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Descrição</label>
                                        <input id="description" name="description" type="text" class="form-control" placeholder="Descrição do sorteio" value="{{ $sort->description }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="type">Tipo</label>
                                        <select name="type" id="type" class="form-control select2">
                                            <option value="geral" selected>Geral</option>
                                            <option value="loja">Loja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="store_id">Loja</label>
                                        <select name="store_id" id="store_id" class="form-control select2">
                                            <option value="">Todas</option>
                                            @foreach ($stores as $store)
                                                @if ($store->id == $sort->store_id)
                                                    <option value="{{ $store->id }}" selected>{{ $store->name }}</option>    
                                                @else
                                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="initial_date">Data de Inicio</label>
                                        <input type="date" value="{{ $sort->initial_date }}" name="initial_date" id="initial_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="final_date">Data de Final</label>
                                        <input type="date" value="{{ $sort->final_date }}" name="final_date" id="final_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="draw_date">Data de Sorteio</label>
                                        <input type="date" value="{{ $sort->draw_date }}" name="draw_date" id="draw_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="limit">Valor Mínimo em compras</label>
                                        <input type="text" onkeypress="$(this).mask('###.##0,00', {reverse: true});" value="{{ number_format($sort->limit,2,",",".") }}" name="limit" id="limit" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('sort.index') }}" class="btn btn-danger">Cancelar</a>
                </div>
                </form>
            
            </div>
        </div>
    </section>
@endif
@endsection