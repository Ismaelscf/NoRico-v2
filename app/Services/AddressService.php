<?php

namespace App\Services;

use App\Models\Address;
use App\Repositories\AddressRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class AddressService
{
    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create($dados, $id){

        $address = [];

        if($dados->type == 'comercial'){
            $address['store_id'] = $id;
        }
        else{
            $address['user_id'] = $id;
        }
        
        $address['type'] = $dados->type;
        $address['state'] = $dados->state;
        $address['city'] = $dados->city;
        $address['district'] = $dados->district;
        $address['street'] = $dados->street;
        $address['number'] = $dados->number;
        $address['complement'] = $dados->complement;

        return $this->addressRepository->create($address);
    }

    public function search($field, $value){

        try {
           
            $address = $this->addressRepository->search($field, $value);

            $address = $address[0];

            return $address;

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function edit($address, $store_id){
        
        $addressEdit = $this->search('store_id', $store_id);
        
        $addressEdit->street = $address->street;
        $addressEdit->number = $address->number;
        $addressEdit->complement = $address->complement;
        $addressEdit->district = $address->district;
        $addressEdit->city = $address->city;
        $addressEdit->state = $address->state;
        $addressEdit->type = $address->type;

        $address = $this->addressRepository->edit($addressEdit);

        return $address;
    }
}