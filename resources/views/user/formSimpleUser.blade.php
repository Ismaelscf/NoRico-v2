<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                // width: 'resolve',
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@section('content')
@if($permition != 'cliente')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

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

                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Cadastrar Usuário</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="/user/newSimpleUser" enctype="multipart/form-data" method="POST">
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
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" onkeypress="$(this).mask('(00) 00000-0000');" id="phone" name="phone" placeholder="Telefone" required>
                            </div>
                        </div>

                        {{-- <div class="row form-group" div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>

                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" onclick="showPass()" id="showpass" name="showpass">
                                    <label for="showpass" class="custom-control-label">Exibir Senha</label>
                                </div>
                            </div>
                        </div> --}}

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