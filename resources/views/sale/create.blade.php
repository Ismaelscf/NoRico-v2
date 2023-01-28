@if(isset($user))
<div class="card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Vender</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
       
        
            
            <form action="{{ route('sales.confirm'); }}" enctype="multipart/form-data" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label for="user_id">Cliente:</label>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="store_id" name="store_id" value="{{ $store->id }}">
                    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee }}">
                    <input type="hidden" name="discount" id="discount" value="{{ $store->percentage_discount }}">
                    <input type="hidden" name="userName" id="userName" value="{{ $user->name }}">
                    {{ $user->name }}
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Breve descrição da compra" required>
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Valor da Compra:</label>
                    <input type="number" step="0.001" name="price" id="price" class="form-control" placeholder="Apenas numeros" required>
                </div>
            </div>
    </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Vender</button>
        </div>
        </form>

</div>
@endif