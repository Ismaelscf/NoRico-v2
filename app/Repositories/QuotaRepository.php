<?php

namespace App\Repositories;

use App\Models\Quota;

class QuotaRepository
{
    protected $quota;

    public function __construct(Quota $quota)
    {
        $this->quota = $quota;
    }

    public function create($quota){   
        return $this->quota::create($quota); 
    }

    public function buscarTodos(){
        $quotas = Quota::all();
        return $quotas;
    }

    public function search($id){
        $quota = Quota::find($id);
        return $quota;
    }

    public function edit($quota){   
        return $quota->save(); 
    }

    public function status($quota){
        return $quota->save();
    }

}