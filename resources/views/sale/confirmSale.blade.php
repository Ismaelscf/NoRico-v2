@if($saleConfirm)
<div class="card card-gray-dark">

    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Confirmar Venda</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
       
        
            
            <form action="{{ route('sales.create'); }}" enctype="multipart/form-data" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label for="user_id">Cliente:</label>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $saleConfirm->user_id }}">
                    <input type="hidden" id="store_id" name="store_id" value="{{ $saleConfirm->store_id }}">
                    <input type="hidden" id="employee_id" name="employee_id" value="{{ $saleConfirm->employee_id }}">
                    <input type="hidden" id="sale_date" name="sale_date" value="{{ $saleConfirm->sale_date }}">
                    <input type="hidden" id="total_sale" name="total_sale" value="{{ $saleConfirm->total_sale }}">
                    <input type="hidden" id="discount" name="discount" value="{{ $saleConfirm->discount }}">
                    <input type="hidden" id="description" name="description" value="{{ $saleConfirm->description }}">

                    {{ $saleConfirm->userName }}
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Compra:</label>
                    {{ $saleConfirm->description }}
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Total da Compra sem desconto:</label>
                    R$ {{ number_format($saleConfirm->total_sale, 2,",",".") }}
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Desconto recebido:</label>
                    R$ {{ number_format($saleConfirm->discount, 2,",",".") }}
                </div>
                <div class="col-sm-12 col-md-12">
                    <label for="price">Valor da Compra com desconto:</label>
                    R$ {{ number_format($saleConfirm->total_sale - $saleConfirm->discount, 2,",",".")  }}
                </div>
            </div>
    </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Vender</button>
        </div>
        </form>

</div>
@endif