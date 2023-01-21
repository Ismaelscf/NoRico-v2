<?php

namespace App\Repositories;

use App\Models\Installment;

class InstallmentRepository
{
    protected $installment;

    public function __construct(Installment $installment)
    {
        $this->installment = $installment;
    }

    public function create($installment){  
        return $this->installment::create($installment); 
    }

    public function search($id, $user){
        // dd($id, $user);  
        $installment = Installment::where('quota_id', $id)->where('user_id', $user)->get();
        return $installment; 
    }
}