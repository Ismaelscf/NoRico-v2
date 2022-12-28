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
        return $this->store::All();
    }

    public function create($storeCreate){
        // dd($storeCreate, 'Repository');

        $this->store::create($storeCreate);

    }

    public function edit(Store $store){
        return $store->save();
    }

    public function searchStore($field, $value){
        return $this->store->where($field, '=', $value)->get();
    }

    public function inactive(Store $store){
        return $store->save();
    }
}