<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function create(Address $address){
        return $address->save();
    }

    public function edit(Address $address){
        return $address->save();
    }

    public function search($field, $value){
        return $this->address->where($field, '=', $value)->get();
    }
}