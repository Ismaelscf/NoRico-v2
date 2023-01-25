<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Services\StoreEmployeeService;
use App\Services\StoreService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{

    protected $saleService;
    protected $userService;
    protected $employeeService;
    protected $storeService;

    public function __construct(SaleService $saleService, UserService  $userService, StoreEmployeeService $employeeService, StoreService $storeService)
    {
        $this->saleService = $saleService;
        $this->userService = $userService;
        $this->employeeService = $employeeService;
        $this->storeService = $storeService;
    }

    public function index($user = null){

        $salesman = Auth::user();
        $permition = $salesman->actors->function;
        $sales = null;


        if($permition == 'admin'){
            $sales = $this->saleService->getAll();

            return view('sale.index', ['sales' => $sales, 'permition' => $permition]);

        }
        else if($permition != 'cliente' && $salesman->employee == true){

            $sales = $this->saleService->getAll($salesman->employee->store->id);

        }

        return view('sale.index', ['sales' => $sales, 'permition' => $permition, 'store' => $salesman->employee->store, 'employee' => $salesman->employee->id, 'user' => $user]);
    }

    public function searchUser(Request $request){

        $user = $this->userService->buscarPorCPF($request->cpf);

        if($user == null){
            return 'Cliente não encontrado';
        }

        return $this->index($user);
    }

    public function create(Request $request){

        $result = $this->saleService->create($request);

        return $this->index();
    }
}
