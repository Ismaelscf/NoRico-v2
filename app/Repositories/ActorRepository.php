<?php

namespace App\Repositories;

use App\Models\Actor;

class ActorRepository
{
    protected $actor;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function create($actor){   
        return $this->actor::create($actor); 
    }

    public function buscarPorIdUser($id){
        return $this->actor->where('user_id', $id)->first();
    }

    public function edit(Actor $actor){
        // dd($actor);
        return $actor->save();
    }

    public function getAllManager(){
        $manager = Actor::where('function', 'gerente')->where('active', '=', 1)->get();
        return $manager;
    }

    public function getAllClients(){
        $clients = Actor::where('function', 'cliente')->get();
        return $clients;
    }

    public function buscarUserClient($user){
        $clients = Actor::where('user_id', $user)->where('function','cliente')->pluck('user_id');
        return $clients;
    }

}