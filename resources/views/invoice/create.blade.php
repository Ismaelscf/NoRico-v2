<div class="card card-gray-dark collapsed-card">

    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Gerar Faturas</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('invoices.create'); }}" enctype="multipart/form-data" method="post">
        @csrf <!-- {{ csrf_field() }} -->

        <h5>Data de referencias</h5>
        <div class="row">
            <div class="col-md-4 col-sm-8">
                <div class="form-group">
                    <label for="initial_date">Inicial</label>
                    <input id="initial_date" name="initial_date" type="text" class="form-control" value="{{ date('d/m/Y', strtotime('first day of last month')) }}" disabled>
                </div>
            </div>
            <div class="col-md-4 col-sm-8">
                <div class="form-group">
                    <label for="final_date">Final</label>
                    <input id="final_date" name="final_date" type="text" class="form-control" value="{{ date('d/m/Y', strtotime('last day of last month')) }}" disabled>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Gerar Faturas</button>
    </div>
    </form>

</div>
