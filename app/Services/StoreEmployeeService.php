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
}