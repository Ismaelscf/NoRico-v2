<?php

namespace App\Repositories;

use App\Models\StoreEmployee;

class StoreEmployeeRepository
{
    protected $storeEmployee;

    public function __construct(StoreEmployee $storeEmployee)
    {
        $this->storeEmployee = $storeEmployee;
    }

    public function getAll($store_id = null){
        if($store_id){
            return $this->storeEmployee->where('store_id', '=', $store_id)->get();
        } else {
            return $this->storeEmployee::All();
        }
    }

    public function create($employeeCreate){
        return $this->storeEmployee::create($employeeCreate);
    }

    public function searchEmployee($field, $value){
        return $this->storeEmployee->where($field, '=', $value)->get();
    }

    public function edit(StoreEmployee $storeEmployee){
        return $storeEmployee->save();
    }

    public function inactive(StoreEmployee $storeEmployee){
        return $storeEmployee->save();
    }

    public function getAllManager(){
        return $this->storeEmployee->where('function', 'gerente')->get();
    }
}