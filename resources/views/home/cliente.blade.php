<div class="container-fluid">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>1</h3>
                    <p>Cotas Adquiridas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>53</h3>
                    <p>Compras Realizadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R$ 5.500,00</h3>
                    <p>Economizados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $dados['totalSorts'] }}</h3>
                    <p>Sorteios Ativos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        
    </div>


    {{-- Sorteios Ativos --}}
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Sorteios Ativos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div id="carouselSorts" class="carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i=0;?>
                        @foreach ($dados['sorts'] as $sort)
                            @if($i == 0)
                                <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                            @endif
                                <div class="card">
                                    <div class="img-wrapper">
                                        @if($sort->image != null)
                                            <img src="{{ $sort->image }}" alt="...">
                                        @else
                                            <img src="https://www.sindsaude.com.br/wp-content/uploads/2018/11/modelo-face3-2-850x560.jpg" class="card-img-top" alt="...">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;">{{ $sort->description }}</h5>
                                    <p class="card-text">
                                        De {{ date('d/m/Y' , strtotime( $sort->initial_date)) }} à {{ date('d/m/Y' , strtotime( $sort->final_date)) }}<br>
                                        
                                        Sorteio: {{ $sort->type }} - 
                                        @if($sort->store_id)
                                        Apenas da Loja: {{ $sort->store->name }}<br>
                                        @else
                                        Todas Lojas participam<br>
                                        @endif

                                        Valor minimo em compras: R${{ number_format($sort->limit, 2, ',', '.') }}
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <?php $i++;?>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
    {{-- Sorteios Ativos --}}
    <br>
    {{-- Rede de Descontos Novo Rico --}}
    <div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Nossos Parceiros</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    </div>
    {{-- Rede de Descontos Novo Rico --}}

</div>