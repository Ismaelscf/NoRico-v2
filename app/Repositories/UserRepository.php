<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($dados){
        
        $dados = json_decode (json_encode ($dados), FALSE);

        $user = new User();
        $user->name = $dados->name;
        $user->cpf = $dados->cpf;
        $user->password = Hash::make($dados->password);
        $user->email = $dados->email;
        $user->phone = $dados->phone;
        $user->photo = $dados->photo;
        $user->save();
    }

    public function buscarIdPorCPF($cpf){
        $user = User::where('cpf', $cpf)->first();

        return $user->id;
    }
}