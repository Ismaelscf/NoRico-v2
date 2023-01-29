<?php

namespace App\Repositories;

use App\Models\UserQuota;

class UserQuotaRepository
{
    protected $userQuota;

    public function __construct(UserQuota $userQuota)
    {
        $this->userQuota = $userQuota;
    }

    public function create($userQuota){
        // dd($userQuota, 'Repository');

        $userQuota = $this->userQuota::create($userQuota);
        return $userQuota;

    }

    public function edit($userQuota){ 
        // dd($user);  
        return $userQuota->save(); 
    }

    public function buscarCotas($user){ 
        $cotas = UserQuota::where('user_id', $user)->get();
        // dd($cotas);
        return $cotas; 
    }

    public function buscarCotasporPlano($id){ 
        $cotas = UserQuota::where('user_quotas_id', $id)->get();
        // dd($cotas);
        return $cotas; 
    }
}