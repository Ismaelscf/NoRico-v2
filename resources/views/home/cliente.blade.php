<div class="container-fluid">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $dados['totalSales'] }}</h3>
                    <p>Compras feitas por você</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $dados['winner'] }}</h3>
                    <p>Pessoas sorteadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R$ {{ number_format($dados['totalDiscounte'],2,",",".") }}</h3>
                    <p>Economizados por você</p>
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

            <h5 class="mt-4 mb-2 ml-2">Sorteios Ativos</h5>

            <div id="carouselSorts" class="carousel" data-bs-ride="carouselSorts">
                <div class="carousel-inner" id="carousel-inner-sort">
                    <?php $i=0;?>
                    @foreach ($dados['sorts'] as $sort)
                        @if($i == 0)
                            <div class="carousel-item carousel-item-sort active">
                        @else
                            <div class="carousel-item carousel-item-sort">
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
                <button class="carousel-control-prev" id="carousel-control-prev-sort" type="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" id="carousel-control-next-sort" type="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>

    </div>
    {{-- Sorteios Ativos --}}
    <br>
    {{-- Rede de Descontos Novo Rico --}}
    <div class="row">
    
    <div class="col-12">

        <h5 class="mt-4 mb-2 ml-2">Nossos Parceiros</h5>

        <div id="carouselStore" class="carousel" data-bs-ride="carouselStore">
            <div class="carousel-inner" id="carousel-inner-store">
                <?php $i=0;?>
                @foreach ($dados['stores'] as $store)
                    @if($i == 0)
                        <div class="carousel-item carousel-item-store active">
                    @else
                        <div class="carousel-item carousel-item-store">
                    @endif
                        <div class="card">
                            <div class="img-wrapper">
                                @if($store->logo != null)
                                    <img src="{{ $store->logo }}" alt="...">
                                @else
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUaxVpI6It7Fbnn0MyzPvkMOMSEQSIPjiZpsZIl49fHYwmCyFPIgtbB9XwQWcFumSDd_w&usqp=CAU" class="card-img-top" alt="...">
                                @endif
                            </div>
                            <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">{{ $store->name }}</h5>
                            <p class="card-text">
                                Telefone: {{ $store->phone }}<br>
                                E-mail: {{ $store->email }}<br>
                                Descontos de até: {{ $store->percentage_discount }}%<br>
                                Endereço: {{ $store->adresses->street }}, {{ $store->adresses->number }}, {{ $store->adresses->complement }}, {{ $store->adresses->district }}, {{ $store->adresses->city }} - {{ $store->adresses->state }}
                            </p>
                            </div>
                        </div>
                    </div>
                    <?php $i++;?>
                @endforeach
            </div>
            <button class="carousel-control-prev" id="carousel-control-prev-store" type="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" id="carousel-control-next-store" type="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    </div>
    {{-- Rede de Descontos Novo Rico --}}

</div>