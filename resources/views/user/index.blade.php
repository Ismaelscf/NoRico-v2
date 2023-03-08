<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/exampleTable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')
@if($permition == 'admin' || $permition == 'vendedor')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-gray-dark collapsed-card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Cadastrar Usuário</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-plus"></i>
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
                        <form action="/user/newUser" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome Completo" required>
                        </div>
                        
                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" onkeypress="$(this).mask('000.000.000-00');" id="cpf" name="cpf" placeholder="CPF" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>

                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" onclick="showPass()" id="showpass" name="showpass">
                                    <label for="showpass" class="custom-control-label">Exibir Senha</label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" onkeypress="$(this).mask('(00) 00000-0000');" id="phone" name="phone" placeholder="Telefone" required>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            
                        <div class="col-sm-12 col-md-3">
                            <label for="image">Foto</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <label for="payday">Dia de vencimento</label>
                            <input type="number" name="payday" id="payday" class="form-control" min="1" max="28" required>
                        </div>

                            <div class="col-sm-6">
                                <label>Função</label>
                                <select class="form-control" id="function" name="function">
                                    <option value="cliente">Cliente</option>
                                    <option value="vendedor">Vendedor</option>
                                    <option value="gerente">Gerente</option>
                                </select>
                            </div>

                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" required>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-4">
                                <label for="district">Bairro</label>
                                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="street">Rua</label>
                                <input type="text" class="form-control" id="street" name="street" placeholder="Rua" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="number">Número</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="Número" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="complement">Complemento</label>
                            <input type="text" class="form-control" id="complement" name="complement" placeholder="Complemento (Ponto de Referência)">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Todos os Usúarios</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body">
                        <table class="table table_base dataTables_wrapper dt-bootstrap4" id="example1" name="example1">
                            <thead>

                                <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Função</th>
                                <th scope="col">Cpf</th> 
                                <th scope="col">Email</th>
                                <th scope="col">phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opções</th>            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->function}}</td>
                                    <td>{{$user->formatar_cpf($user->cpf)}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->formatar_phone($user->phone)}}</td>
                                    <td>
                                    @if($user->active)
                                        <i class="fas fa-circle" style="color: green"></i>
                                        <span style="display: none">{{ $user->active }}</span>
                                    @else
                                        <i class="fas fa-circle" style="color: red"></i>
                                        <span style="display: none">{{ $user->active }}</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.edit') }}/{{ $user->id }}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>

                                        @if($user->active)
                                            <a href="{{ route('user.status') }}/{{ $user->id }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                                        @else
                                            <a href="{{ route('user.status') }}/{{ $user->id }}" class="btn btn-warning btn-sm"><i class="fa fa-asterisk"></i> Reativar</a>
                                        @endif

                                        @if(count($user->installments))
                                        <a href="{{ route('quotas.hiring') }}/{{ $user->id }}" class="btn btn-secondary btn-sm">Contratar Plano</a>
                                        <a href="{{ route('installment.track_parcels') }}/{{ $user->id }}" class="btn btn-success btn-sm">Ver Parcelas</a>
                                            
                                        @else
                                        <a href="{{ route('quotas.hiring') }}/{{ $user->id }}" class="btn btn-secondary btn-sm">Contratar Plano</a>
                                        
                                            
                                        @endif


                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                    </div>

                </div>

            </div>
        </div>

    </section>
@endif
@endsection