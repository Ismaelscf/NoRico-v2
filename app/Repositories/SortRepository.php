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

    public function create($sortCreate){
        return $this->sort::create($sortCreate);
    }

    public function searchSort($field, $value){
        return $this->sort->where($field, '=', $value)->get();
    }

    public function edit(Sort $sort){
        return $sort->save();
    }

    public function inactive(Sort $sort){
        return $sort->save();
    }

    public function search($id){
        $sort = Sort::find($id);
        return $sort;
    }
}