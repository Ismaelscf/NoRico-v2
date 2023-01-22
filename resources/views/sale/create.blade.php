<div class="card collapsed-card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Vender</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
       
        @if(isset($user))
            
            <form action="{{ route('sales.create'); }}" enctype="multipart/form-data" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label for="user_id">Cliente:</label>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="store_id" name="store_id" value="{{ $store->id }}">
                    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee }}">
                    <input type="hidden" name="discount" id="discount" value="{{ $store->percentage_discount }}">
                    <input class="form-control" type="text" id="userName" name="userName" value="{{ $user->name }}" disabled>
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Valor da Compra:</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Apenas numeros">
                </div>
            </div>
    </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Vender</button>
        </div>
        </form>

    @else

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
    
    @endif

</div>