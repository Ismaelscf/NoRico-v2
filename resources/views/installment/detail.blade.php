@extends('layouts.app')

@push('script-fisrt')
@endpush

@section('content')
    <section class="content">
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
        <div class="row">
            <div class="col-sm-6">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Usuário</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="card sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    @if (isset($user->photo))
                                        <img class="img-thumbnail img-fluid" src="{{asset($user->photo)}}">
                                    @endif
                                </div>
                                

                                <div class="col-sm-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->name}}</h5>
                                        <p class="card-text"><b>CPF:</b> {{$user->cpf}}<br><b>Email:</b> {{$user->email}}<br><b>Telefone:</b> {{$user->phone}}<br><b>Estado:</b> {{$user->address->state}}<br><b>Cidade:</b> {{$user->address->city}}<br><b>Estado:</b> {{$user->address->district}}<br><b>Rua:</b> {{$user->address->street}}<br><b>Número:</b> {{$user->address->number}}<br><b>Complemento:</b> {{$user->address->complement}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img class="img-thumbnail img-fluid" src="{{asset('assets/dist/img/Plain.jpg')}}">
                                </div>

                                <div class="col-sm-8">
                                    <div class="card-body">
                                        <h3>Detalhes do Plano</h3>
                                        <h5 class="card-title">{{$quota->description}}</h5>
                                        <p class="card-text"><b>Valor Total:</b> {{$quota->total_price}}<br><b>Data Inicial:</b> {{$quota->initial_date}}<br><b>Data Final:</b> {{$quota->final_date}}<br><b>Limite do Plano por Cliente:</b> {{$quota->customer_limit}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
            <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Parcelas</h3>

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
                                @foreach($installment as $quota)
                                <tr>
                                    <td>{{ $quota->id }}</td>
                                    <td>{{ $quota->description }}</td>
                                    <td>{{ $quota->total_price }}</td>
                                    <td>{{ $quota->customer_limit }}</td>
                                    <td>{{ $quota->initial_date }}</td>
                                    <td>{{ $quota->final_date }}</td>
                                    <td>
                                    @if($quota->active)
                                        <i class="fas fa-circle" style="color: green"></i>
                                        <span style="display: none">{{ $quota->active }}</span>
                                    @else
                                        <i class="fas fa-circle" style="color: red"></i>
                                        <span style="display: none">{{ $quota->active }}</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/quotas/edit/{{$quota->id}}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>
                                        @if($quota->active)
                                            <a href="{{ route('quotas.status') }}/{{ $quota->id }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                                        @else
                                            <a href="{{ route('quotas.status') }}/{{ $quota->id }}" class="btn btn-warning btn-sm"><i class="fa fa-asterisk"></i> Reativar</a>
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

    </section>
    
@endsection