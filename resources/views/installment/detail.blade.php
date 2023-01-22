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
                                <th scope="col">Valor</th>
                                <th scope="col">Data Referência</th>
                                <th scope="col">Status</th> 
                                <th scope="col">Opções</th>
           
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($installments as $installment)
                                    <tr>
                                        <td>R$ {{number_format($installment->price,2,",",".") }}</td>
                                        <td>R$ {{$installment->due_date}}</td>
                                        <td>
                                            @if($installment->payday)
                                            <span class="badge badge-success">Pago</span>
                                            @else
                                            <span class="badge badge-info">Em aberto</span>
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
                                                            @if($installment->payday)
                                                            <div class="form-group col-md-4">
                                                                <label for="date">Data:  </label>
                                                                <input type="text" class="form-control" id="date-{{$installment->id}}" name="date"  value="{{ $installment->updated_at->format('d-m-Y H:i:s') }}" readonly>
                                                            </div>
                                                            @endif

                                                            @if(!$installment->payday)
                                                            <div class="col-sm-2 align-self-center">
                                                            <a href="/installment/pay/{{$installment->id}}">
                                                                <button class="btn btn-primary btn-sm">Atualizar</button>
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

    </section>
    
@endsection