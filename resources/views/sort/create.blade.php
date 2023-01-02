<div class="card collapsed-card">

    <div class="card-header ui-sortable-handle bg-gray-dark">
        <h3 class="card-title">Cadastrar novo sorteio</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('sort.create'); }}" enctype="multipart/form-data" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <label for="image">Capa</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input id="description" name="description" type="text" class="form-control" placeholder="Descrição do sorteio" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control select2">
                                <option value="geral" selected>Geral</option>
                                <option value="loja">Loja</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="store_id">Loja</label>
                            <select name="store_id" id="store_id" class="form-control select2">
                                {{-- @foreach ( as )
                                    
                                @endforeach --}}
                                <option value="geral" selected>Geral</option>
                                <option value="loja">Loja</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
    </form>

</div>
