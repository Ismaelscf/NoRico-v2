<div class="card">
    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
        <h3 class="card-title">Todos os Funcionários</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>

    </div>

    <div class="card-body">
        <table class="table table_base dataTable" id="dataTable">
            <thead>

                <tr>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Função</th>
                    <th scope="col">CPF</th> 
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Opções</th>            
                </tr>
            </thead>
            <tbody>
                @foreach($users as $employee)
                <tr>
                    <td>{{$employee->user->name}}</td>
                    <td>{{$employee->user->actors->function}}</td>
                    <td>{{$employee->user->cpf}}</td>
                    <td>{{$employee->user->email}}</td>
                    <td>{{$employee->user->phone}}</td>
                    <td>
                    @if($employee->user->active)
                        <i class="fas fa-circle" style="color: green"></i>
                        <span style="display: none">{{ $employee->user->active }}</span>
                    @else
                        <i class="fas fa-circle" style="color: red"></i>
                        <span style="display: none">{{ $employee->user->active }}</span>
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit') }}/{{ $employee->user->id }}" class="btn btn-primary btn-sm"><i class="fa  fa-eye"></i> Detalhes</a>

                        @if($employee->user->active)
                            <a href="{{ route('user.status') }}/{{ $employee->user->id }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Desativar</a>
                        @else
                            <a href="{{ route('user.status') }}/{{ $employee->user->id }}" class="btn btn-warning btn-sm"><i class="fa fa-asterisk"></i> Reativar</a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Função</th>
                    <th scope="col">CPF</th> 
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Opções</th> 
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="card-footer">
    </div>

</div>