<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\ActorService;
use App\Services\SaleService;

class InvoiceService
{
    protected $invoiceRepository;
    protected $actorService;

    public function __construct(InvoiceRepository $invoiceRepository, ActorService $actorService)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->actorService = $actorService;
    }

    public function generateInvoiceBatch(){

        $initial_date = date('Y-m-d', strtotime('first day of last month'));
        $final_date = date('Y-m-d', strtotime('last day of last month'));

        $invoice = $this->invoiceRepository->generateInvoiceUser($initial_date, $final_date);

        foreach($invoice as $venda){

            echo 
                "ID do usuário das vendas: ".$venda->user_id.
                "<br>Total em compras: ".$venda->total_sales.
                "<br>Total de descontos recebidos: ".$venda->total_discount.
                "<br>Valor a pagar para o Rico: ".$venda->total_discount * 0.8.
                "<br>Valor de beneficio recebido: ".$venda->total_discount * 0.2.
                "<br>Data de Vencimento: ".date('Y')."-".date('m')."-".$venda->payday.
                "<br>Status: fechada
                <br><br><br>"
            ;
        }
    }

    public function generateInvoice(){

    }
}