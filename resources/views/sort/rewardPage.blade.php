@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/exampleTable.js') }}"></script>

    
    <script>
        console.log('teste');
        $(document).ready(function() {
            $('.select2').select2({
                // width: 'resolve',
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@section('content')
    <section class="content">
        <div class="row">

            @if(isset($result) && $result == 'Error')
                <div class="alert alert-danger" role="alert">
                    Erro, A data final não pode anteceder a data inicial. Sorteio Não cadastrado
                </div>
            @elseif(isset($result) && $result != null)
                <div class="alert alert-success" role="alert">
                    {{ $result }}
                </div>
            @endif
            

            <div class="card card-gray-dark">

                <div class="card-header ui-sortable-handle">
                    <h3 class="card-title">Detalhe sorteio</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            
                <div class="card-body">
                    <form action="{{ route('sort.winner') }}" enctype="multipart/form-data" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="id" id="id" value="{{ $sort->id }}">
                    <input type="hidden" name="users" id="users" value="{{ $ids }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            @if (isset($sort->image))
                                <img class="img-circle" width="200" src="{{ asset($sort->image) }}" alt="Capa do sorteio">
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <h3>{{ $sort->description }}</h3>
                                </div>
                                <div class="col-12 col-sm-12">
                                    De {{ date('d/m/Y' , strtotime( $sort->initial_date)) }} à {{ date('d/m/Y' , strtotime( $sort->final_date)) }}
                                </div>
                                <div class="col-12 col-sm-12">
                                    Tipo de sorteio: {{ $sort->type }} - 
                                    @if($sort->store_id)
                                    Loja: {{ $sort->store->name }}
                                    @else
                                    Lojas: Todas
                                    @endif
                                </div>
                                <div class="col-12 col-sm-12">
                                    Valor minimo em descontos: R${{ number_format($sort->limit, 2, ',', '.') }}
                                </div>
                                <div class="col-12 col-sm-12">
                                    @if ($sort->award == null)
                                        <button type="submit" class="btn btn-block btn-success">Sortear</button>
                                    @else
                                        <br>
                                        <h6>Vencedor(a)</h6>
                                        <h3>{{ $sort->users->name}}</h3>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
            
                </div>
            
                <div class="card-footer">
                    <a href="{{ route('sort.index') }}" class="btn btn-danger">Voltar</a>
                </div>
                </form>
            
            </div>

            <div class="col-md-12">
                <div class="card card-gray-dark" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">Todos os Usúarios Aptos</h3>

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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->actors->function}}</td>
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
@endsection