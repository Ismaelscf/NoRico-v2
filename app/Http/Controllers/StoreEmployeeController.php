<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StoreEmployeeService;
use App\Services\StoreService;

class StoreEmployeeController extends Controller
{
    protected $storeEmployeeService;

    protected $storeService;

    public function __construct(StoreEmployeeService $storeEmployeeService, StoreService $storeService)
    {
        $this->storeEmployeeService = $storeEmployeeService;
        $this->storeService = $storeService;
    }

    public function index($store_id, $result = null){

        $users = $this->storeEmployeeService->getAll($store_id);

        return view('employee.index', ['store_id' => $store_id, 'users' => $users]);
    }

    public function create(Request $request){

        $result = $this->storeEmployeeService->create($request);

        return $this->index($request->store_id, $result);
    }
}
