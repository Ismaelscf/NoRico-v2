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
    protected $addressRepository;
    protected $actorRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository, ActorRepository $actorRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->actorRepository = $actorRepository;
    }
    
    public function formatar_cpf($cpf){
        $cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
        return $cpf;
    }

    public function remover_caracteres($texto){
        $texto = str_replace(".", "", $texto);
        $texto = str_replace(",", "", $texto);
        $texto = str_replace("-", "", $texto);
        $texto = str_replace("/", "", $texto);
        $texto = str_replace("(", "", $texto);
        $texto = str_replace(")", "", $texto);
        $texto = str_replace(" ", "", $texto);
        return $texto;
    }

    public function create($dados){


        //Inicia o Database Transaction

        DB::beginTransaction();

        // //Recupera os dados do formulário
        // $dataForm = $request->all();
        // $newUser = User::create($dataForm);
        // $newAccount = Account::create([
        //     'user_id'    => $newUser->id,
        //     'number'     => uniqid(date('YmdHis')),
        // ]);
        // if( $newUser && $newAccount ) {
        //     //Sucesso!
        //     DB::commit();
        // } else {
        //     //Fail, desfaz as alterações no banco de dados
        //     DB::rollBack();
        // }
        try {
            
            $user['name'] = $dados->name;
            $user['cpf'] = $this->remover_caracteres($dados->cpf);
            $user['password'] = Hash::make($dados->password);
            $user['payday'] = $dados->payday;
            $user['email'] = $dados->email;
            $user['phone'] = $this->remover_caracteres($dados->phone);

            if($dados->hasFile('image') && $dados->file('image')->isValid()){
                $upload = new UploadImage;
                $user['photo'] = $upload->upload($dados->image, 'users');
            }     
            // dd($user);
            $save = $this->userRepository->create($user);

            
            $user = $this->userRepository->buscarIdPorCPF($this->remover_caracteres($dados->cpf));

            $address['type'] = 'pessoal';
            $address['user_id']  = $user;
            $address['state'] = $dados->state;
            $address['city'] = $dados->city;
            $address['district'] = $dados->district;
            $address['street'] = $dados->street;
            $address['number'] = $dados->number;
            $address['complement'] = $dados->complement;

            $save2 = $this->addressRepository->create($address);
            
            $actor['user_id'] = $user;
            $actor['function'] = $dados->function;

            $save3 = $this->actorRepository->create($actor);
            if(isset($save) && isset($save2) && isset($save3)){
                DB::commit();
            }
            else{
                DB::rollBack();                
            }
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

    public function buscarUserSort($users){
        try {
            $user = $this->userRepository->searchUsers($users);
            // dd($user);
            return $user;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function buscarIdPorCPF($cpf){
        $user = $this->userRepository->buscarIdPorCPF($this->remover_caracteres($cpf));
        return $user;
    }

    public function buscarPorCPF($cpf){
        $user = $this->userRepository->buscarPorCPF($this->remover_caracteres($cpf));
        return $user;
    }

    public function buscarClientesPorCPF($cpf){
        $user = $this->userRepository->buscarClientesPorCPF($this->remover_caracteres($cpf));
        return $user;
    }

    public function editUser($dados){
        try {
            $user = $this->userRepository->search($dados->id);
            $user->name = $dados->name;
            $user->cpf = $this->remover_caracteres($dados->cpf);
            $user->password = Hash::make($dados->password);
            $user->payday = $dados->payday;
            $user->email = $dados->email;
            $user->phone = $this->remover_caracteres($dados->phone);

            if($dados->hasFile('image') && $dados->file('image')->isValid()){
                $upload = new UploadImage;
                $user->photo = $upload->upload($dados->image, 'users');
            }
            
            // dd($user);

            $this->userRepository->edit($user);

            // dd($user);

            $address = $this->addressRepository->buscarPorIdUser($user->id);

            $address->state = $dados->state;
            $address->city = $dados->city;
            $address->district = $dados->district;
            $address->street = $dados->street;
            $address->number = $dados->number;
            $address->complement = $dados->complement;

            $this->addressRepository->edit($address);

            $actor = $this->actorRepository->buscarPorIdUser($user->id);

            $actor->user_id = $user->id;
            $actor->function = $dados->function;

            $this->actorRepository->edit($actor);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Usuario Atualizado';
        return $msg;


    }

    public function buscarTodos(){
        $users = $this->userRepository->buscarTodos();
        return $users;
    }

    public function buscarTodosFuncionarios(){
        $users = $this->userRepository->buscarTodosFuncionarios();
        return $users;
    }

    public function createSimpleUser($dados){

        //Inicia o Database Transaction
        DB::beginTransaction();
        try {
            
            $user['name'] = $dados->name;
            $user['cpf'] = $this->remover_caracteres($dados->cpf);
            $user['password'] = Hash::make($user['cpf']);
            $user['payday'] = 1;
            $user['email'] = $user['cpf'].'@osnovosricos.com.br';
            $user['phone'] = $this->remover_caracteres($dados->phone);

            if($dados->hasFile('image') && $dados->file('image')->isValid()){
                $upload = new UploadImage;
                $user['photo'] = $upload->upload($dados->image, 'users');
            }     
            // dd($user);
            $save = $this->userRepository->create($user);

            
            $user = $this->userRepository->buscarIdPorCPF($this->remover_caracteres($dados->cpf));

            $address['type'] = 'pessoal';
            $address['user_id']  = $user;
            $address['state'] = 'Maranhão';
            $address['city'] = 'Nova Olinda';
            $address['district'] = 'Centro';
            $address['street'] = 'Rua do Comercio';
            $address['number'] = 's/n';
            $address['complement'] = 'casa';

            $save2 = $this->addressRepository->create($address);
            
            $actor['user_id'] = $user;
            $actor['function'] = 'cliente';

            $save3 = $this->actorRepository->create($actor);
            if(isset($save) && isset($save2) && isset($save3)){
                DB::commit();
            }
            else{
                DB::rollBack();                
            }
        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Usuario Criado';
        return $msg;
    }
}