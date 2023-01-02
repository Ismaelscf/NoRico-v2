<?php

namespace App\Repositories;

use App\Models\Sort;

class SortRepository
{
    protected $sort;

    public function __construct(Sort $sort)
    {
        $this->sort = $sort;
    }

    public function getAll($store_id = null){

        if($store_id){
            return $this->sort->where('store_id', '=', $store_id)->get();
        } else {
            return $this->sort::All();
        }
    }
}