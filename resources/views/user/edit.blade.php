@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/exampleTable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Atualizar Usuário</h3>

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
                        <form action="/user/edit" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$user->id}}" >
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Nome Completo" required>
                        </div>
                        
                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" onkeypress="$(this).mask('000.000.000-00');" value="{{ $user->formatar_cpf($user->cpf) }}"id="cpf" name="cpf" placeholder="CPF" required>
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
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Email" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" onkeypress="$(this).mask('(00) 00000-0000');" value="{{ $user->formatar_phone($user->phone) }}" id="phone" name="phone" placeholder="Telefone" required>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            
                        <div class="col-sm-12 col-md-3">
                            <label for="image">Foto</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <label for="payday">Dia de vencimento</label>
                            <input type="number" value="{{ $user->payday }}" name="payday" id="payday" class="form-control" min="1" max="28" required>
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
                                <input type="text" class="form-control" value="{{ $user->address->state }}" id="state" name="state" placeholder="Estado" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control" value="{{ $user->address->city }}" id="city" name="city" placeholder="Cidade" required>
                            </div>
                        </div>

                        <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="district">Bairro</label>
                                <input type="text" class="form-control" value="{{ $user->address->district }}" id="district" name="district" placeholder="Bairro" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="street">Rua</label>
                                <input type="text" class="form-control" value="{{ $user->address->street }}" id="street" name="street" placeholder="Rua" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="number">Número</label>
                                <input type="text" class="form-control" value="{{ $user->address->number }}" id="number" name="number" placeholder="Número" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="complement">Complemento</label>
                            <input type="text" class="form-control" value="{{ $user->address->complement }}" id="complement" name="complement" placeholder="Complemento (Ponto de Referência)">
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