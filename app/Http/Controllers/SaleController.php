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

    public function index($user = null, $result = null, $saleConfirm = null){

        $salesman = Auth::user();
        $permition = $salesman->actors->function;
        $sales = null;

        if($permition == 'admin'){
            $sales = $this->saleService->getAll();

            return view('sale.index', ['sales' => $sales, 'permition' => $permition, 'result' => $result]);

        }
        else if($permition != 'cliente' && $salesman->employee == true && $salesman->active == 1){
            
            if(!isset($salesman->employee->store->id)){

                $result = "Seu cadastro ainda não foi vinculado a uma loja, verifique com o administrador do sistema!";

                return redirect('/')->with('result', 'Você ainda não foi cadastrado a uma loja, verifique com o administrador do sistema!');
            }

            $sales = $this->saleService->getAll($salesman->employee->store->id);

        } else if ($permition != 'cliente' && $salesman->employee == false || $salesman->active != 1){

            $result = "Seu cadastro ainda não foi vinculado a uma loja ou você pode estar inativo, verifique com o administrador do sistema!";

            return redirect('/')->with('result', 'Você ainda não foi cadastrado a uma loja ou pode estar inativo, verifique com o administrador do sistema!');
        }

        return view('sale.index', ['sales' => $sales, 'permition' => $permition, 'store' => $salesman->employee->store, 'employee' => $salesman->employee->id, 'user' => $user, 'result' => $result, 'saleConfirm' => $saleConfirm]);
    }

    public function searchUser(Request $request){

        $user = $this->userService->buscarPorCPF($request->cpf);

        if($user == null){
            $result = 'Cliente não encontrado';
            return $this->index(null, $result);
        }

        if($user->active != 1){
            $result = "Usuário Inativo";
            return $this->index(null, $result);
        }

        return $this->index($user);
    }

    public function confirm(Request $request){

        $saleConfirm = $this->saleService->saleConfirm($request);

        return $this->index(null, $saleConfirm['result'], $saleConfirm['salesConfirm']);
    }

    public function confirmUnlimited(Request $request){

        $saleConfirm = $this->saleService->saleConfirmUnlimited($request);

        return $this->index(null, $saleConfirm['result'], $saleConfirm['salesConfirm']);
    }

    public function create(Request $request){

        $result = $this->saleService->create($request);

        // return $this->index(null, $result);
        return redirect('/sales')->with('result', $result);
    }
}
