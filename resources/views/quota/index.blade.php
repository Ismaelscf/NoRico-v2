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
                        <form action="" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="description">Plano</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Nome do Plano" required>
                        </div>
                        
                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="total_price">Valor Total</label>
                                <input type="text" class="form-control" id="total_price" name="total_price" placeholder="Valor Total do plano" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="customer_limit">Limite do Plano</label>
                                <input type="text" class="form-control" id="customer_limit" name="customer_limit" placeholder="Limite do Plano" required>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="initial_date">Data Inicial</label>
                                <input type="date" class="form-control" id="initial_date" name="initial_date" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="final_date">Data Final</label>
                                <input type="date" class="form-control" id="final_date" name="final_date" required>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Planos Cadastrados</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body">
                        <table class="table table_base" id="example1" name="example1">
                            <thead>

                                <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Plano</th>
                                <th scope="col">Valor Total</th> 
                                <th scope="col">Limite do Plano</th>
                                <th scope="col">Data Inicial</th>
                                <th scope="col">Data Final</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opções</th>            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>XXXXX</td>
                                    <td>Plano</td>
                                    <td>Valor Total</td>
                                    <td>Limite do Plano</td>
                                    <td>Data Inicial</td>
                                    <td>Data Final</td>
                                    <td><i class="fas fa-circle" style="color: red"></i></td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                    </div>

                </div>

            </div>

        </div>

    </section>
    
@endsection