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

    public function create($dados, $id){

        // dd($dados, $user);
        $dados = json_decode (json_encode ($dados), FALSE);


        $address = new Address();

        if($dados->type == 'comercial'){
            $address->store_id = $id;
        }
        else{
            $address->user_id = $id;
        }
        
        $address->type = $dados->type;
        $address->state = $dados->state;
        $address->city = $dados->city;
        $address->district = $dados->district;
        $address->street = $dados->street;
        $address->number = $dados->number;
        $address->complement = $dados->complement;

        $address->save();

    }
}