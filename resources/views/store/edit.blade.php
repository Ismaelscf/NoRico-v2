<?php $address = $store->adresses;?>
@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="card">

                    <div class="card-header ui-sortable-handle bg-gray-dark">
                        <h3 class="card-title">Detalhes Loja</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                
                    <div class="card-body">
                        <form action="{{ route('store.editPost'); }}" enctype="multipart/form-data" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                        <input type="hidden" name="id" id="id" value="{{ $store->id }}">
                        <input type="hidden" name="active" id="active" value="{{ $store->active }}">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <label for="image">Logo</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                @if (isset($store->logo))
                                    <img class="img-circle" width="200" src="{{ asset($store->logo) }}" alt="Logo Loja">
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nome da Loja" required value="{{ $store->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="manager">Gerente</label>
                                            <select name="manager" id="manager" class="form-control select2">
                                                {{-- @foreach ($managers as $manager)
                                                    <option value="{{ $manager->id }}">{{ $store->name }}</option>    
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="loja@provedor.com" required value="{{ $store->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="phone">Telefone</label>
                                            <input id="phone" name="phone" type="text" class="form-control"  onkeypress="$(this).mask('(00) 00000-0000');" placeholder="(98) 9 9999-9999" required value="{{ $store->formatar_phone($store->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="cnpj">CNPJ</label>
                                            <input id="cnpj" name="cnpj" type="text" class="form-control" onkeypress="countDocument(this)" placeholder="123456789/0001-85" required value="{{ $store->formatar_document($store->cnpj) }}">
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label for="full_discount">Desconto mensal em R$</label>
                                        <input type="text" name="full_discount" id="full_discount" class="form-control" onkeypress="$(this).mask('###.##0,00', {reverse: true});" placeholder="99.00" value="{{ number_format($store->full_discount,2,",",".") }}">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="percentage_discount">Desconto mensal em %</label>
                                        <input type="text" name="percentage_discount" id="percentage_discount" class="form-control" onkeypress="$(this).mask('00,00', {reverse: true});" placeholder="99.00" value="{{ number_format($store->percentage_discount,2,",",".") }}">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <br>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="discount" name="discount" @if($store->discount == 1) checked @endif>
                                            <label for="discount" class="custom-control-label">Oferece Desconto</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="sort" name="sort" @if($store->sort == 1) checked @endif>
                                            <label for="sort" class="custom-control-label">Oferece Sorteio</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <h5>Endereço</h5>
                        <div class="row">
                            <div class="col-md-4 col-sm-8">
                                <div class="form-group">
                                    <label for="street">Rua</label>
                                    <input id="street" name="street" type="text" class="form-control" placeholder="Rua, Avenida, Alameda" required value="{{ $address->street }}">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input id="number" name="number" type="text" class="form-control" placeholder="123, SN" required value="{{ $address->number }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input id="complement" name="complement" type="text" class="form-control" placeholder="Bloco, apartamento, próximo de" required value="{{ $address->complement }}">
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-md-4 col-sm-8">
                                <div class="form-group">
                                    <label for="district">Bairro</label>
                                    <input id="district" name="district" type="text" class="form-control" placeholder="Nome do bairro" required value="{{ $address->district }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-8">
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input id="city" name="city" type="text" class="form-control" placeholder="Nome do cidade" required value="{{ $address->city }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-8">
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <input id="state" name="state" type="text" class="form-control" placeholder="Nome do estado" required value="{{ $address->state }}">
                                </div>
                            </div>
                        </div>
                
                    </div>
                
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{ route('store.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                    </form>
                
                </div>
                
            </div>

        </div>
    </section>    
    
@endsection