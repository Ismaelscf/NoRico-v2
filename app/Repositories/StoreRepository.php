<?php

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\Request;

class StoreRepository
{
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function getAll(){
        // return $this->store::All();
        $lojas = $this->store::All();
        dd($lojas[0]);
    }

    public function create(array $storeCreate){
        // dd($storeCreate, 'Repository');

        $this->store::create($storeCreate);

    }

    public function searchStore($field, $value){
        return $this->store->where($field, '=', $value)->get();
    }
}