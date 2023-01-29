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
        $installment = Installment::where('quota_id', $id)->where('user_id', $user)->get();
        return $installment; 
    }

    public function searchInstallment($id){
        $installment = Installment::find($id);
        return $installment; 
    }

    public function buscarTodos(){
        $installments = Installment::all();
        return $installments;
    }

    public function BuscarCotasContratadas($id){
        $quotas = Installment::select('quota_id')->where('user_id', $id)->distinct()->get();
        return $quotas;
    }

    public function BuscarUserQuotas($id){
        $quotas = Installment::where('user_quotas_id', $id)->get();
        // dd($quotas);
        return $quotas;
    }

    public function edit($installment){ 
        $installment->save();
        return $installment; 
    }
}