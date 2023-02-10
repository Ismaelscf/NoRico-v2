<?php

namespace App\Services;

use App\Repositories\ActorRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ActorService
{
    protected $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function getAllManager(){
        $manager = $this->actorRepository->getAllManager();
        return $manager;
    }

    public function buscarUserClient($users){

        $aptos = array();
        
        foreach($users as $user){
            $cliente = $this->actorRepository->buscarUserClient($user);

            if(Count($cliente)){
                array_push($aptos, $user);
            }
        }
        
        return $aptos;

    }
}