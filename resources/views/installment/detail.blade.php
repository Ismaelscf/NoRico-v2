<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

@push('script-fisrt')
<script src="{{ asset('js/exampleTable.js') }}"></script>
@endpush

@section('content')
    @if($permition == 'admin' || $permition == 'cliente' || $permition == 'vendedor')
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
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
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
                                        <p class="card-text"><b>CPF:</b> {{$user->formatar_cpf($user->cpf)}}<br><b>Email:</b> {{$user->email}}<br><b>Telefone:</b> {{$user->formatar_phone($user->phone)}}<br><b>Dia de vencimento:</b> {{$user->payday}}<br><b>Estado:</b> {{$user->address->state}}<br><b>Cidade:</b> {{$user->address->city}}<br><b>Estado:</b> {{$user->address->district}}<br><b>Rua:</b> {{$user->address->street}}<br><b>Número:</b> {{$user->address->number}}<br><b>Complemento:</b> {{$user->address->complement}}</p>

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
                                        <p class="card-text"><b>Valor Total:</b> {{number_format($quota->total_price,2,",",".")}}<br><b>Data Inicial:</b> {{date('d/m/Y', strtotime($quota->initial_date))}}<br><b>Data Final:</b> {{date('d/m/Y', strtotime($quota->final_date))}}<br><b>Limite do Plano por Cliente:</b> {{number_format($quota->customer_limit,2,",",".")}}</p>

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
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Parcelas</h3>

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
                                <th scope="col">Valor</th>
                                <th scope="col">Data Referência</th>
                                <th scope="col">Cota</th>
                                <th scope="col">Status</th> 
                                <th scope="col">Opções</th>
           
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($installments as $installment)
                                    <tr>
                                        <td>R$ {{number_format($installment->price,2,",",".") }}</td>
                                        <td>{{date('d/m/Y', strtotime($installment->due_date))}}</td>
                                        <td>{{$installment->user_quotas_id}}</td>
                                        <td>
                                            @if($installment->status == 'aberto')
                                            <span class="badge badge-info">Em aberto</span>
                                            @elseif($installment->status == 'pago')
                                            <span class="badge badge-success">Pago</span>
                                            @else
                                            <span class="badge badge-warning">Em atraso</span>
                                            @endif
                                        <td>
                                            <div>
                                                <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapse-{{$installment->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                    Detalhes
                                                </button>
                                            </div>
                                            
                                        </td>
  
                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                        
                                            <div class="collapse" id="collapse-{{$installment->id}}">
                                                <div class="card card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="valor">Vendedor:  </label>
                                                                <input type="text" class="form-control" size="12" id="valor-{{$installment->id}}" name="value" value="{{$installment->seller->name}}" readonly>
                                                            </div>
                                                            @if($installment->status == 'pago')
                                                            <div class="form-group col-md-4">
                                                                <label for="date">Data:  </label>
                                                                <input type="text" class="form-control" id="date-{{$installment->id}}" name="date"  value="{{ $installment->updated_at->format('d-m-Y H:i:s') }}" readonly>
                                                            </div>
                                                            @endif

                                                            @if($installment->status != 'pago')
                                                            <div class="col-sm-2 align-self-center">
                                                            <a href="/installment/pay/{{$installment->id}}">
                                                            @if( Auth::user()->actors->function == "admin" || Auth::user()->actors->function == "vendedor" )
                                                                <button class="btn btn-primary btn-sm">Pagar</button>
                                                            @endif
                                                            </a>
                                                            <a href="/installment/delay/{{$installment->id}}">
                                                            @if( Auth::user()->actors->function == "admin" || Auth::user()->actors->function == "vendedor" )
                                                                <button class="btn btn-warning btn-sm">Atrasada</button>
                                                            @endif
                                                            </a>
                                                            </div>
                                                            @endif

                                                        </div>


                                                    
                                                    



                                                </div>
                                            </div>
                                         
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