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

    public function generateInvoice(){
        $actors = $this->actorService->getAllClients();

        // dd($actors[1]->user->id, $actors[1]->user->payday);
        foreach ($actors as $actor) {
            $vendas = DB::table('sales')
                        ->select('user_id', DB::raw('SUM(total_sale) AS total_sale'), DB::raw('SUM(discount) AS discount'))
                        ->where('user_id', '=', $actor->user->id)
                        ->where('sale_date', '>=', '2023-03'.$actor->user->payday)
                        ->groupBy('user_id')
                        ->get();
        
            // Use os resultados da query para criar as faturas para cada cliente do usuário atual.
        }


        return $actors;
    }
}