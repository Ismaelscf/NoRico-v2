<div class="card collapsed-card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Buscar Cliente</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('sales.searchUser'); }}" enctype="multipart/form-data" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label for="cpf">CPF:</label>
                    <input type="number" name="cpf" id="cpf" class="form-control" placeholder="Apenas numeros">
                </div>
            </div>

    </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Buscar Cliente</button>
        </div>
        </form>

</div>