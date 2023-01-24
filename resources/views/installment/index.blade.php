@extends('layouts.app')

@push('script-fisrt')
@endpush

@section('content')
    <section class="content justify-content-md-center">
        <div class="row justify-content-md-center">
            <div class="col-md-6 justify-content-md-center">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Selecionar Plano</h3>

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
                        <form action="\installment" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="user" name="user" value="@if(isset($id)) {{$id}} @else {{Auth::user()->id}} @endif" >
                            <label>Planos</label>
                            <select class="form-control" id="quota" name="quota">
                                @foreach($quotas as $quota)
                                <option value="{{$quota->quota->id}}">Plano: {{$quota->quota->description}}, Valor do Plano: {{$quota->quota->total_price}}, Desconto: {{$quota->quota->customer_limit}}, Inicio: {{$quota->quota->initial_date}}, Fim: {{$quota->quota->final_date}}.</option>
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
    
@endsection