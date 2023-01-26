@extends('layouts.app')

@push('script-fisrt')
@endpush

@section('content')


<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                    <h3 class="card-title">Cadastrar Plano</h3>

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
                    <form action="/quotas/edit" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{$quota->id}}" >
                    <div class="form-group">
                        <label for="description">Plano</label>
                        <input type="text" class="form-control" id="description" value="{{ $quota->description }}" name="description" placeholder="Nome do Plano" required>
                    </div>
                    
                    <div class="row form-group" div class="col-sm-12">
                        <div class="col-sm-6">
                            <label for="total_price">Valor Total</label>
                            <input type="text" class="form-control" id="total_price" value="{{ number_format($quota->total_price,2,",",".") }}" name="total_price" placeholder="Valor Total do plano" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="customer_limit">Limite do Plano por Cliente</label>
                            <input type="text" class="form-control" id="customer_limit" value="{{ number_format($quota->customer_limit,2,",",".") }}" name="customer_limit" placeholder="Limite do Plano" required>
                        </div>
                    </div>

                    <div class="row form-group" div class="col-sm-12">
                        <div class="col-sm-6">
                            <label for="initial_date">Data Inicial</label>
                            <input type="date" class="form-control" id="initial_date" value="{{ $quota->initial_date }}" name="initial_date" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="final_date">Data Final</label>
                            <input type="date" class="form-control" id="final_date" value="{{ $quota->final_date }}" name="final_date" required>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
                </form>
            </div>
        </div>
    
    </div>
</section>

@endsection