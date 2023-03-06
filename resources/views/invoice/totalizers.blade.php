<div class="container-fluid">

    <?php
    $totalInvoice = 0;
    $totalReceived = 0;
    $totalPending = 0;
    $pending = 0;
    $received = 0;
    foreach($invoices as $invoice){
        $totalInvoice++;
        if($invoice->status == 'fechada'){
            $totalPending += $invoice->pay;
            $pending++;
        } else if($invoice->status == 'paga'){
            $totalReceived += $invoice->pay;
            $received++;
        }
    }
    // dd($totalInvoice, $totalReceived, $totalPending, $pending, $received);
    ?>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-12">
        
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $totalInvoice }}</h3>
                    <p>Total de Faturas emitidas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xs-12">
        
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R$ {{ number_format($totalReceived,2,",",".") }}</h3>
                    <p>Total Recebidos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-xs-12">
        
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>R$ {{ number_format($totalPending,2,",",".") }}</h3>
                    <p>Total a receber</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-xs-12">
        
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $received }}</h3>
                    <p>Quantidade de Faturas Pagas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-xs-12">
        
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $pending }}</h3>
                    <p>Quantidade de Faturas a receber</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        
    </div>

</div>