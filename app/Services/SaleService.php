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

class SaleService
{
    protected $saleRepository;
    protected $storeService;

    public function __construct(SaleRepository $saleRepository, StoreService $storeService)
    {
        $this->saleRepository = $saleRepository;
        $this->storeService = $storeService;
    }

    public function getAll($store_id = null){      
        return $this->saleRepository->getAll($store_id);
    }

    public function getAllSalesUser(){}

    public function calcTotalSales(){}

    public function calcTotalDiscount(){}

    public function create(Request $request){
        // dd($request->all());

        try{
            $initial_date = date('Y-m-01');
            $final_date = date('Y-m-d');
            $salesByUser = $this->saleRepository->getAllSalesUser($request->store_id, $request->user_id, $initial_date, $final_date);
            $discount = ($request->price * $request->discount) / 100;

            $discountTotal = 0;

            foreach($salesByUser as $saleUser){
                $discountTotal += $saleUser->discount;
            }

            $discountTotal += $discount;

            $store = $this->storeService->searchStore('id', $request->store_id);

            if($discountTotal >= $store->full_discount){
                return "Este cliente já atingiu o limite de descontos oferecidos pelo estabelecimento";
            } else {

            $sales['user_id'] = $request->user_id;
            $sales['store_id'] = $request->store_id;
            $sales['employee_id'] = $request->employee_id;
            $sales['total_sale'] = $request->price;
            $sales['discount'] = $discount;
            $sales['sale_date'] = date('Y-m-d');

            $this->saleRepository->create($sales);

            return "Venda realizada com Sucesso";

            }
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }
}