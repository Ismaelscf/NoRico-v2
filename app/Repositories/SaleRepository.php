<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    protected $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
    
    public function getAll($store_id = null){
        if($store_id){
            return $this->sale->where('store_id', '=', $store_id)->get();
        } else {
            return $this->sale::All();
        }
    }

    public function getAllSalesUser($store_id, $user_id, $initial_date, $final_date){
        return $this->sale->where('user_id', '=', $user_id)->where('sale_date', '>=', $initial_date)->where('sale_date', '<=', $final_date)->where('store_id', '=', $store_id)->get();
    }

    public function create($salesCreate){
        return $this->sale::create($salesCreate);
    }
}