<div class="card collapsed-card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Cadastrar Loja</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('store.create'); }}" enctype="multipart/form-data" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <label for="image">Logo</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Nome da Loja" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="loja@provedor.com" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input id="phone" name="phone" type="phone" class="form-control" placeholder="(98) 9 9999-9999" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" placeholder="123456789/0001-85" required>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="full_discount">Desconto em R$</label>
                        <input type="number" name="full_discount" id="full_discount" class="form-control" placeholder="99.00">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="percentage_discount">Desconto em %</label>
                        <input type="number" name="percentage_discount" id="percentage_discount" class="form-control" placeholder="99.00">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <br>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="discount" checked="" name="discount">
                            <label for="discount" class="custom-control-label">Oferece Desconto</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="sort" checked="" name="sort">
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
                    <input id="street" name="street" type="text" class="form-control" placeholder="Rua, Avenida, Alameda" required>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="number">Número</label>
                    <input id="number" name="number" type="text" class="form-control" placeholder="123, SN" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="complement">Complemento</label>
                    <input id="complement" name="complement" type="text" class="form-control" placeholder="Bloco, apartamento, próximo de" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-8">
                <div class="form-group">
                    <label for="district">Bairro</label>
                    <input id="district" name="district" type="text" class="form-control" placeholder="Nome do bairro" required>
                </div>
            </div>
            <div class="col-md-4 col-sm-8">
                <div class="form-group">
                    <label for="city">Cidade</label>
                    <input id="city" name="city" type="text" class="form-control" placeholder="Nome do cidade" required>
                </div>
            </div>
            <div class="col-md-4 col-sm-8">
                <div class="form-group">
                    <label for="state">Estado</label>
                    <input id="state" name="state" type="text" class="form-control" placeholder="Nome do estado" required>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
    </form>

</div>
