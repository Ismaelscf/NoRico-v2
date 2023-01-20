<?php

namespace App\Services;

use App\Repositories\StoreEmployeeRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\UserService;

class StoreEmployeeService
{
    protected $storeEmployeeRepository;
    protected $userService;

    public function __construct(StoreEmployeeRepository $storeEmployeeRepository, UserService $userService)
    {
        $this->storeEmployeeRepository = $storeEmployeeRepository;
        $this->userService = $userService;
    }

    public function getAll($store_id){
        return $this->storeEmployeeRepository->getAll($store_id);
    }

    public function create(Request $request){

        $this->userService->create($request);

        $user = $this->userService->buscarIdPorCPF($request->cpf);

        $storeEmployee['store_id'] = $request->store_id;
        $storeEmployee['user_id'] = $user;
        $storeEmployee['function'] = $request->function;
        $storeEmployee['active'] = 1;

        $this->storeEmployeeRepository->create($storeEmployee);        
    }

    public function searchEmployee($field, $value){

        try {
           
            $employee = $this->storeEmployeeRepository->searchEmployee($field, $value);

            $employee = $employee[0];

            return $employee;

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function inactive($id){

        try {

            $search = $this->storeEmployeeRepository->searchEmployee('id', $id);

            if($search[0]->id == $id){

                $employee = $search[0];
                $employee->active = !$search[0]->active;

                $this->userService->status($employee->user_id);

                return $this->storeEmployeeRepository->inactive($employee);
            } else {
                $error = 'Funcionário não encontrado';
                return $error;
            }

        }  catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}