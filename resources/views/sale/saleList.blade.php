<div class="card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Todas as Vendas</h3>
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
                    <th>Data</th>
                    <th>Total da Venda</th>
                    <th>Desconto</th>
                    <th>Total com Desconto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Loja</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr class="even">
                        <td>{{ $sale->sale_date }}</td>
                        <td>R$ {{ number_format($sale->total_sale,2,",",".") }}</td>
                        <td>R$ {{ number_format($sale->discount,2,",",".") }}</td>
                        <td>R$ {{ number_format(($sale->total_sale - $sale->discount),2,",",".") }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->employee->user->name }}</td>
                        <td>{{ $sale->store->name }}</td>
                        <td>
                            {{-- <a href="{{ route('sort.edit') }}/{{ $sort->id }}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Data</th>
                    <th>Total da Venda</th>
                    <th>Disconto</th>
                    <th>Total com Desconto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Loja</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
