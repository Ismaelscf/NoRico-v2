<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\ActorService;

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
        $actors = $this->actorService->getAllClients();

        $vendas = array();
        // dd($actors[1]->user->id, $actors[1]->user->payday);
        foreach ($actors as $actor) {
            array_push($vendas, DB::table('users')
            ->leftJoin('sales', function ($join) use ($actor) {
                $join->on('users.id', '=', 'sales.user_id')
                    ->where('sale_date', '>=', '2023-03'.$actor->user->payday);
            })
            ->select('users.id as user_id', DB::raw('COALESCE(SUM(total_sale), 0) AS total_sale'), DB::raw('COALESCE(SUM(discount), 0) AS discount'))
            ->where('users.id', '=', $actor->user->id)
            ->groupBy('users.id')
            ->get());
        
            // Use os resultados da query para criar as faturas para cada cliente do usuário atual.
        }
        // dd($vendas);

        
        if($vendas[36][0]->total_sale > 0){
            $rico = $vendas[36][0]->discount * 0.8;
            $benefico = $vendas[36][0]->discount * 0.2;
        }
        

        dd(
            "id do usuário: ".$actors[36]->user->id,
            "nome do usuário: ".$actors[36]->user->name,
            "Total em compras: ".$vendas[36][0]->total_sale,
            "Total de descontos recebidos: ".$vendas[36][0]->discount,
            "Valor a pagar para o Rico: ".$rico,
            "Valor de beneficio recebido: ".$benefico
        );


        return $actors;
    }

    public function generateInvoice(){

    }
}