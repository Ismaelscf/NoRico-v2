<div class="card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Todos os sorteios</h3>
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
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Loja</th>
                    <th>Tipo</th>
                    <th>Data Inicial</th>
                    <th>Data Final</th>
                    <th>Data do Sorteio</th>
                    <th>A partir de R$</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sorts as $sort)
                    <tr class="even">
                        <td>
                            @if($sort->active)
                                <i class="fas fa-circle" style="color: green"></i>
                                <span style="display: none">{{ $sort->active }}</span>
                            @else
                                <i class="fas fa-circle" style="color: red"></i>
                                <span style="display: none">{{ $sort->active }}</span>
                            @endif
                        </td>
                        <td>{{ $sort->id }}</td>
                        <td>{{ $sort->description }}</td>
                        <td>{{ $sort->store ? $sort->store->name : 'Todas as Lojas' }}</td>
                        <td>{{ $sort->type }}</td>
                        <td>{{ $sort->initial_date }}</td>
                        <td>{{ $sort->final_date }}</td>
                        <td>{{ $sort->draw_date }}</td>
                        <td>R$ {{ number_format($sort->limit,2,",",".") }}</td>
                        <td>
                            @if($sort->award == null)
                                <a href="{{ route('sort.edit') }}/{{ $sort->id }}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>

                                @if($sort->active)
                                    <a href="{{ route('sort.inactive') }}/{{ $sort->id }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                                @else
                                    <a href="{{ route('sort.inactive') }}/{{ $sort->id }}" class="btn btn-warning btn-sm"><i class="fa fa-asterisk"></i> Reativar</a>
                                @endif
                            
                                <a href="{{ route('sort.rewardPage') }}/{{ $sort->id }}" class="btn btn-success btn-sm"><i class="fa  fa-gift"></i> Sortear</a>
                            @else
                                <a href="{{ route('sort.rewardPage') }}/{{ $sort->id }}" class="btn btn-success btn-sm"><i class="fa  fa-gift"></i> Ver Vencedor</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Loja</th>
                    <th>Tipo</th>
                    <th>Data Inicial</th>
                    <th>Data Final</th>
                    <th>Data do Sorteio</th>
                    <th>A partir de R$</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
