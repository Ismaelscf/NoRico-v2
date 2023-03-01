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
        $actors = $this->actorService->getAllClients();

        $sales = array();
        // dd($actors[1]->user->id, $actors[1]->user->payday);
        foreach ($actors as $actor) {

            $user_id = $actor->user->id;

            $initial_date = date('Y-m-d', strtotime('first day of last month'));
            $final_date = date('Y-m-d', strtotime('last day of last month'));

            // $data_vencimento = '2023-03-'.$actor->user->payday;

            $invoice = $this->invoiceRepository->generateInvoiceUser($user_id, $initial_date, $final_date);

            if(!$invoice->isEmpty()){
                array_push($sales, $invoice);
            } else {
                array_push($sales, [['user_id' => $user_id, 'total_sale' => 0, 'total_discount' => 0]]);
            }

            

            // array_push($vendas, [DB::table('users')
            // ->leftJoin('sales', function ($join) use ($actor, $data_vencimento) {
            //     $join->on('users.id', '=', 'sales.user_id')
            //         ->where('sale_date', '<=', $data_vencimento);
            // })
            // ->select('users.id as user_id', DB::raw('COALESCE(SUM(total_sale), 0) AS total_sale'), DB::raw('COALESCE(SUM(discount), 0) AS discount'))
            // ->where('users.id', '=', $actor->user->id)
            // ->groupBy('users.id')
            // ->get(), $data_vencimento]);
        
            // Use os resultados da query para criar as faturas para cada cliente do usuário atual.
        }
        dd($sales);

        foreach($sales as $venda){

            if($venda[0]->total_sale > 0){
                $rico = $venda[0]->total_discount * 0.8;
                $benefico = $venda[0]->total_discount * 0.2;
            } else {
                $rico = 0;
                $benefico = 0;
            }

            echo 
                // "id do usuário: ".$actors[36]->user->id,
                "ID do usuário das vendas: ".$venda[0]->user_id.
                // "nome do usuário: ".$actors[36]->user->name,
                "<br>Total em compras: ".$venda[0]->total_sale.
                "<br>Total de descontos recebidos: ".$venda[0]->discount.
                "<br>Valor a pagar para o Rico: ".$rico.
                "<br>Valor de beneficio recebido: ".$benefico.
                "<br>Data de Vencimento: ".
                "<br>Status: ".
                "<br><br><br>"
            ;
        }

        


        return $actors;
    }

    public function generateInvoice(){

    }
}