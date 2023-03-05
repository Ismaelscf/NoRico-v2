{{-- {{ dd($stores[0]->name); }} --}}
<div class="card card-gray-dark">

    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Todas as Faturas</h3>
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
                    <th>Cliente</th>
                    <th>Total de Compras</th>
                    <th>Total de Descontos</th>
                    <th>Comissão Rico</th>
                    <th>Beneficio Recebido</th>
                    <th>Dia de Pagamento</th>
                    <th>Data de Referencia</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr class="even">
                        <td>
                           {{ $invoice->user->name }}
                           <span class="visually-hidden">{{ $invoice->user->cpf }}</span>
                        </td>
                        <td>R$ {{ number_format($invoice->total_sale,2,",",".") }}</td>
                        <td>R$ {{ number_format($invoice->discount,2,",",".") }}</td>
                        <td>R$ {{ number_format($invoice->pay,2,",",".") }}</td>
                        <td>R$ {{ number_format($invoice->received,2,",",".") }}</td>
                        <td>{{ date('d/m/Y', strtotime($invoice->payday)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($invoice->reference_date)) }}</td>
                        <td>{{ $invoice->status }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>

                            @if($invoice->status != 'paga' && $permition == 'admin')
                                <a href="{{ route('invoices.payment') }}/{{ $invoice->id }}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Pagar</a>

                                {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fa  fa-users"></i> Mudar Status</a> --}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Cliente</th>
                    <th>Total de Compras</th>
                    <th>Total de Descontos</th>
                    <th>Comissão Rico</th>
                    <th>Beneficio Recebido</th>
                    <th>Dia de Pagamento</th>
                    <th>Data de Referencia</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
