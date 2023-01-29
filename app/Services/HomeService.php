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

class HomeService
{

    protected $homeRepository;
    protected $sortService;
    protected $storeService;
    protected $saleService;

    public function __construct(HomeRepository $homeRepository, SortService $sortService){
        $this->homeRepository = $homeRepository;
        $this->sortService = $sortService;
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
                    $sorts = $this->sortService->getAllSortActive();
                    $totalSorts = count($sorts);

                    $dados['totalSorts'] = $totalSorts;
                    $dados['sorts'] = $sorts;

                    return $dados;
                    break;
                default :
            }

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}