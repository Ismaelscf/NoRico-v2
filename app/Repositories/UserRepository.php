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

    public function create($user){  
        return $this->user::create($user); 
    }

    public function edit($user){   
        return $user->save(); 
    }

    public function buscarIdPorCPF($cpf){
        $user = User::where('cpf', $cpf)->first();

        return $user->id;
    }

    public function search($id){
        $user = User::find($id);
        return $user;
    }

    public function status($user){
        return $user->save();
    }

    public function buscarTodos(){
        $users = User::all();

        return $users;
    }
}