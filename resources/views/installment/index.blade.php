@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/exampleTable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
@endpush

@section('content')
    <section class="content justify-content-md-center">
        <div class="row justify-content-md-center">
            <div class="col-md-8 justify-content-md-center">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Visualizar por Plano</h3>

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
                                <option value="{{$quota->quota->id}}">Plano: {{$quota->quota->description}}, Valor do Plano: R$ {{ number_format($quota->quota->total_price,2,",",".") }}; Desconto: R$ {{ number_format($quota->quota->customer_limit,2,",",".") }}; Inicio: {{ date('d/m/Y', strtotime($quota->quota->initial_date)) }}, Fim: {{ date('d/m/Y', strtotime($quota->quota->final_date)) }}.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Visualizar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <section class="content justify-content-md-center">
        <div class="row justify-content-md-center">
            <div class="col-md-8 justify-content-md-center">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Visualizar por Cotas</h3>

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
                        <form action="\installment\track_quotas" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="user" name="user" value="@if(isset($id)) {{$id}} @else {{Auth::user()->id}} @endif" >
                            <label>Planos</label>
                            <select class="form-control" id="quota" name="quota">
                                @foreach($userQuotas as $quota)
                                <option value="{{$quota->id}}">Cota: {{$quota->id}}; Plano: {{$quota->quota->description}}, Valor do Plano: R$ {{ number_format($quota->quota->total_price,2,",",".") }}; Desconto: R$ {{ number_format($quota->quota->customer_limit,2,",",".") }}; Inicio: {{ date('d/m/Y', strtotime($quota->initial_date)) }}, Fim: {{ date('d/m/Y', strtotime($quota->final_date)) }}.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="" class="btn btn-success">Visualizar 2</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    
@endsection