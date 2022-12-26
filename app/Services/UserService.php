<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\AddressRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    public function create($dados){

        // dd($dados);
        try {
            
            $this->userRepository->create($dados);
            $user = $this->userRepository->buscarIdPorCPF($dados['cpf']);
            $dados['type'] = 'pessoal';

            $this->addressRepository->create($dados, $user);

        } catch (Exception $exception) {
            return view('user.index', [
                'msg' =>$exception->getMessage()
            ]);
        }

        $msg = 'Usuario Criado';
        return $msg;
    }

    
}