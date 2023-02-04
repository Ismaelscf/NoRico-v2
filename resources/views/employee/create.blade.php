<div class="card card-gray-dark collapsed-card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Cadastrar Funcionário</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>

    </div>

    <div class="card-body">
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
        <form action="{{ route('employees.create'); }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="store_id" id="store_id" value="{{ $store_id }}">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome Completo" required>
        </div>
        
        <div class="row form-group" div class="col-sm-12">
            <div class="col-sm-6">
                <label for="cpf">CPF</label>
                <input type="text" onkeypress="$(this).mask('000.000.000-00');" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
            </div>

            <div class="col-sm-6">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" onclick="showPass()" id="showpass" name="showpass">
                    <label for="showpass" class="custom-control-label">Exibir Senha</label>
                </div>
            </div>
        </div>

        <div class="row form-group" div class="col-sm-12">
            <div class="col-sm-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="col-sm-6">
                <label for="phone">Telefone</label>
                <input type="text" onkeypress="$(this).mask('(00) 00000-0000');" class="form-control" id="phone" name="phone" placeholder="Telefone" required>
            </div>
        </div>

        <div class="row form-group" div class="col-sm-12">
            
        <div class="col-sm-12 col-md-6">
            <label for="image">Foto</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

            <div class="col-sm-6">
                <label>Função</label>
                <select class="form-control" id="function" name="function">
                    <option value="lojista">Lojista</option>
                    <option value="gerente">Gerente</option>
                </select>
            </div>

        </div>

        <div class="row form-group" div class="col-sm-12">
            <div class="col-sm-6">
                <label for="state">Estado</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" required>
            </div>

            <div class="col-sm-6">
                <label for="city">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" required>
            </div>
        </div>

        <div class="row form-group" div class="col-sm-12">
            <div class="col-sm-4">
                <label for="district">Bairro</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" required>
            </div>

            <div class="col-sm-4">
                <label for="street">Rua</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Rua" required>
            </div>

            <div class="col-sm-4">
                <label for="number">Número</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" required>
            </div>
        </div>

        <div class="form-group">
            <label for="complement">Complemento</label>
            <input type="text" class="form-control" id="complement" name="complement" placeholder="Complemento (Ponto de Referência)">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
    </form>
</div>