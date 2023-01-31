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

class HomeService
{

    protected $homeRepository;
    protected $sortService;
    protected $storeService;
    protected $saleService;
    protected $winnerService;

    public function __construct(HomeRepository $homeRepository, SortService $sortService, WinnerService $winnerService){
        $this->homeRepository = $homeRepository;
        $this->sortService = $sortService;
        $this->winnerService = $winnerService;
    }

    public function home(){

        try{

            $user = Auth::user();
            $permition = $user->actors->function;
            switch($permition){
                case 'admin' :
                    break;
                case 'vendedor' :
                    break;
                case 'cliente' :
                    //Informações de Sorteios e Totalizadores de sorteios e vencedores
                    $sorts = $this->sortService->getAllSortActive();
                    $totalSorts = count($sorts);

                    $dados['totalSorts'] = $totalSorts;
                    $dados['sorts'] = $sorts;

                    $dados['winner'] = $this->sortService->getTotalWinner();

                    //Informações de Parceiros

                    //Informações de Vendas e Descontos

                    return $dados;
                    break;
                default :
            }

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}