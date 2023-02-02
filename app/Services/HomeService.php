<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Repositories\HomeRepository;
use Illuminate\Support\Facades\Auth;
use App\Services\SortService;
use App\Services\WinnerService;
use App\Services\SaleService;
use App\Services\StoreService;

class HomeService
{

    protected $homeRepository;
    protected $sortService;
    protected $storeService;
    protected $saleService;
    protected $winnerService;

    public function __construct(HomeRepository $homeRepository, SortService $sortService, WinnerService $winnerService, SaleService $saleService, StoreService $storeService){
        $this->homeRepository = $homeRepository;
        $this->sortService = $sortService;
        $this->winnerService = $winnerService;
        $this->saleService = $saleService;
        $this->storeService = $storeService;
    }

    public function home(){

        try{

            $user = Auth::user();
            // $permition = $user->actors->function;
            // switch($permition){
            //     case 'admin' :
            //         break;
            //     case 'vendedor' :
            //         break;
            //     case 'cliente' :
                    //Informações de Sorteios e Totalizadores de sorteios e vencedores
                    $sorts = $this->sortService->getAllSortActive();
                    $totalSorts = count($sorts);

                    $dados['totalSorts'] = $totalSorts;
                    $dados['sorts'] = $sorts;

                    $dados['winner'] = $this->sortService->getTotalWinner();

                    //Informações de Parceiros
                    $dados['stores'] = $this->storeService->getAllActive();

                    //Informações de Vendas e Descontos
                     $sales = $this->saleService->getAllSalesAllStoreUser($user->id, date('Y-m-1'), date('Y-m-d'));

                     $discount = 0;
                     foreach($sales as $sale){
                        $discount += $sale->discount;
                     }
                    
                     $dados['totalSales'] = count($sales);
                     $dados['totalDiscounte'] = $discount;

                    return $dados;
                //     break;
                // default :
            // }

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}