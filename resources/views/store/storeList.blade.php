{{-- {{ dd($stores[0]->name); }} --}}
<div class="card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Todas as Loja</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">

        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Desconto em R$</th>
                    <th>Desconto em %</th>
                    <th>Oferece ao Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                {{-- {{ dd($store); }} --}}
                    <tr class="even">
                        <td>
                            @if($store->active)
                                <i class="fas fa-circle" style="color: green"></i>
                                <span style="display: none">{{ $store->active }}</span>
                            @else
                                <i class="fas fa-circle" style="color: red"></i>
                                <span style="display: none">{{ $store->active }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $store->name }}
                        </td>
                        <td>{{ $store->email }}</td>
                        <td>{{ $store->phone }}</td>
                        <td>R$ {{ number_format($store->full_discount,2,",",".") }}</td>
                        <td>{{ number_format($store->percentage_discount,2,",",".") }}%</td>
                        <td>
                            {{ $store->discount ? '- Desconto' : '' }}<br>
                            {{ $store->sort ? '- Sorteio' : ''}}
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>

                            @if($store->active)
                                <a href="{{ route('store.inactive') }}/{{ $store->id }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                            @else
                                <a href="{{ route('store.inactive') }}/{{ $store->id }}" class="btn btn-warning btn-sm"><i class="fa fa-asterisk"></i> Reativar</a>
                            @endif
                        
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Desconto em R$</th>
                    <th>Desconto em %</th>
                    <th>Oferece ao Cliente</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>

        {{-- <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row">

                <div class="col-sm-12 col-md-12">
                    <div id="example1_filter" class="dataTables_filter">
                        <label>Buscar:
                            <input type="search" class="form-control form-control-sm" placeholder="Buscar" aria-controls="example1">
                        </label>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">

                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                    Nome
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    E-mail
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Telefone
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Desconto em R$
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Desconto em %
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Oferece ao Cliente
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Ações
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($stores as $store)
                                <tr class="even">
                                    <td>
                                        @if($store->active)
                                            <i class="fas fa-circle" style="color: green"></i>
                                        @else
                                            <i class="fas fa-circle" style="color: red"></i>
                                        @endif
                                        {{ $store->name }}
                                    </td>
                                    <td>{{ $store->email }}</td>
                                    <td>{{ $store->phone }}</td>
                                    <td>R$ {{ number_format($store->full_discount,2,",",".") }}</td>
                                    <td>{{ number_format($store->percentage_discount,2,",",".") }}%</td>
                                    <td>
                                        {{ $store->discount ? '- Desconto' : '' }}<br>
                                        {{ $store->sort ? '- Sorteio' : ''}}
                                    </td>
                                    <td>
                                        Detalhes - Excluir
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Nome</th>
                                <th rowspan="1" colspan="1">E-mail</th>
                                <th rowspan="1" colspan="1">Telefone</th>
                                <th rowspan="1" colspan="1">Desconto em R$</th>
                                <th rowspan="1" colspan="1">Desconto em %</th>
                                <th rowspan="1" colspan="1">Oferece ao Cliente</th>
                                <th rowspan="1" colspan="1">Ações</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled" id="example1_previous"><a
                                    href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                    class="page-link">Anterior</a></li>
                            <li class="paginate_button page-item active"><a href="#" aria-controls="example1"
                                    data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                    data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                    data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                            <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                    aria-controls="example1" data-dt-idx="7" tabindex="0"
                                    class="page-link">Próxima</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
