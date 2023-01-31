<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\StoreService;
use App\Services\UserService;
use App\Services\UserQuotaService;

class SaleService
{
    protected $saleRepository;
    protected $storeService;
    protected $userService;
    protected $userQuotaService;

    public function __construct(SaleRepository $saleRepository, StoreService $storeService, UserService $userService, UserQuotaService $userQuotaService)
    {
        $this->saleRepository = $saleRepository;
        $this->storeService = $storeService;
        $this->userService = $userService;
        $this->userQuotaService = $userQuotaService;
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }

    public function remover_caracteres($texto){
        $texto = str_replace(".", "", $texto);
        $texto = str_replace(",", "", $texto);
        $texto = str_replace("-", "", $texto);
        $texto = str_replace("/", "", $texto);
        $texto = str_replace("(", "", $texto);
        $texto = str_replace(")", "", $texto);
        $texto = str_replace(" ", "", $texto);
        return $texto;
    }

    public function getAll($store_id = null){      
        return $this->saleRepository->getAll($store_id);
    }

    public function getAllSalesUser(){}

    public function calcTotalSales(){}

    public function calcTotalDiscount(){}

    public function saleConfirm(Request $request){

        try{
            $initial_date = date('Y-m-01');
            $final_date = date('Y-m-d');
            //Todas as compras feitas pelo usuário na loja
            $salesByUser = $this->saleRepository->getAllSalesUser($request->store_id, $request->user_id, $initial_date, $final_date);
            $discount = ($this->removeMask($request->price) * $request->discount) / 100;
            $result = null;

            //Todas as cotas do usuário
            $quotas = $this->userQuotaService->buscarCotas($request->user_id);

            //Soma o limite total do usuário de todas as cotas dele
            $limiteUserForQuota = 0;
            foreach($quotas as $quota){
                $limiteUserForQuota += $quota->quota->customer_limit;
            }

            //Soma o Desconto total que o usuario ja adquiriu na loja
            $discountTotalStore = 0;
            foreach($salesByUser as $saleUser){
                $discountTotalStore += $saleUser->discount;
            }
     
            $store = $this->storeService->searchStore('id', $request->store_id);
            //Pega o limite disponivel para aquele usuário na loja
            $discountAvailable = $store->full_discount - $discountTotalStore;
           
            //Pega todas as compras feitas pelo usuário em todas as lojas
            $salesAllStoreUser = $this->saleRepository->getAllSalesAllStoreUser($request->user_id, $initial_date, $final_date);
 
            //Somo o total de descontos adquiridos pelo usuário em todas as lojas
            $discountTotalUser = 0;
            foreach($salesAllStoreUser as $sales){
                $discountTotalUser += $sales->discount;
            }

            //Estabelece um limite atual de comprar por cota que o usário tem
            $limiteUserForQuota = $limiteUserForQuota - $discountTotalUser;

            // if($limiteUserForQuota <= 0 ){
            //     //Verifica se o usuário ainda tem limite para comprar pelas cotas
            //     $result = "Este cliente já atingiu o limite de descontos oferecidos por sua(s) Cota(s)";
            //     $discount = 0;
            // } else
            if($discountTotalStore >= $store->full_discount){
                //Verifica se o usuário ainda tem limite para comprar na loja
                $result = "Este cliente já atingiu o limite de descontos oferecidos pelo estabelecimento";
                $discount = 0;
            } elseif($discount >= $discountAvailable){
                //Define um limite restante caso o usuário ainda tenha limite para comprar na loja, mas seja menor que o desconto da compra oferece
                $discount = $discountAvailable;
            }

            $sales['user_id'] = $request->user_id;
            $sales['userName'] = $request->userName;
            $sales['store_id'] = $request->store_id;
            $sales['employee_id'] = $request->employee_id;
            $sales['total_sale'] = $this->removeMask($request->price);
            $sales['discount'] = $discount;
            $sales['sale_date'] = date('Y-m-d');
            $sales['description'] = $request->description;

            $salesConfirm = (object) $sales;

            return ['salesConfirm' => $salesConfirm, 'result' => $result];

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function saleConfirmUnlimited(Request $request){

        try{
            $discount = ($this->removeMask($request->price) * $request->discount) / 100;
            $result = null;

            $sales['user_id'] = $request->user_id;
            $sales['userName'] = $request->userName;
            $sales['store_id'] = $request->store_id;
            $sales['employee_id'] = $request->employee_id;
            $sales['total_sale'] = $this->removeMask($request->price);
            $sales['discount'] = $discount;
            $sales['sale_date'] = date('Y-m-d');
            $sales['description'] = $request->description;

            $salesConfirm = (object) $sales;

            return ['salesConfirm' => $salesConfirm, 'result' => $result];

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function create(Request $request){
        // dd($request->all());

        try{
            
            $sales['user_id'] = $request->user_id;
            $sales['store_id'] = $request->store_id;
            $sales['employee_id'] = $request->employee_id;
            $sales['total_sale'] = $request->total_sale;
            $sales['discount'] = $request->discount;
            $sales['sale_date'] = date('Y-m-d');
            $sales['description'] = $request->description;

            $this->saleRepository->create($sales);

            return "Venda finalizada com Sucesso";

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public function buscarConcorrentes($sort)
    {
        if($sort->store_id){
            $users = $this->saleRepository->buscarConcorrentesLoja($sort);
        }
        else {
            $users = $this->saleRepository->buscarConcorrentes($sort);
        }

        $user = $this->userService->buscarUserSort($users);

        return $user;
    }

    public function getAllSalesAllStoreUser($user_id, $initial_date = null, $final_date = null){
        return $this->saleRepository->getAllSalesAllStoreUser($user_id, $initial_date, $final_date);
    }
}