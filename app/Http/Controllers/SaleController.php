<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Services\UserService;

class SaleController extends Controller
{

    protected $saleService;
    protected $userService;

    public function __construct(SaleService $saleService, UserService  $userService)
    {
        $this->saleService = $saleService;
        $this->userService = $userService;
    }

    public function index($store_id = null, $result = null, $user = null){

        $sales = $this->saleService->getAll($store_id);

        return view('sale.index', ['sales' => $sales, 'result' => $result, 'user' => $user]);
    }

    public function searchUser(Request $request){

        $user = $this->userService->buscarPorCPF($request->cpf);

        if($user==null){
            $result = 'Cliente não encontrado';
            return $this->index(null, $result, null);
        }

        return $this->index(null, null, $user);
    }
}
