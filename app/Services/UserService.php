<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\AddressRepository;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UploadImage;
use App\Repositories\ActorRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository, ActorRepository $actorRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->actorRepository = $actorRepository;
    }

    public function create($dados){

        try {
            // dd($dados->all());
            $user['name'] = $dados->name;
            $user['cpf'] = $dados->cpf;
            $user['password'] = Hash::make($dados->password);
            $user['email'] = $dados->email;
            $user['phone'] = $dados->phone;

            if($dados->hasFile('image') && $dados->file('image')->isValid()){
                $upload = new UploadImage;
                $user['photo'] = $upload->upload($dados->image, 'users');
            }     

            $this->userRepository->create($user);

            $user = $this->userRepository->buscarIdPorCPF($dados['cpf']);

            $address['type'] = 'pessoal';
            $address['user_id']  = $user;
            $address['state'] = $dados->state;
            $address['city'] = $dados->city;
            $address['district'] = $dados->district;
            $address['street'] = $dados->street;
            $address['number'] = $dados->number;
            $address['complement'] = $dados->complement;

            $this->addressRepository->create($address);

            $actor['user_id'] = $user;
            $actor['function'] = $dados->function;

            $this->actorRepository->create($actor);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Usuario Criado';
        return $msg;
    }

    public function status($id){

        try {

            $user = $this->userRepository->search($id);

            $user->active = !$user->active;

            return $this->userRepository->status($user);

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function buscarUser($id){
        try {
            $user = $this->userRepository->search($id);
            return $user;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function buscarTodos(){
        $users = $this->userRepository->buscarTodos();
        return $users;
    }
}