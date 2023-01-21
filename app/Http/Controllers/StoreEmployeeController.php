<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StoreEmployeeService;
use App\Services\StoreService;
use App\Services\UserService;

class StoreEmployeeController extends Controller
{
    protected $storeEmployeeService;

    protected $storeService;
    protected $userService;

    public function __construct(StoreEmployeeService $storeEmployeeService, StoreService $storeService, UserService $userService)
    {
        $this->storeEmployeeService = $storeEmployeeService;
        $this->storeService = $storeService;
        $this->userService = $userService;
    }

    public function index($store_id, $result = null){

        $users = $this->storeEmployeeService->getAll($store_id);

        return view('employee.index', ['store_id' => $store_id, 'users' => $users]);
    }

    public function create(Request $request){

        $result = $this->storeEmployeeService->create($request);

        return $this->index($request->store_id, $result);
    }

    public function editForm($id){

        $storeEmployee = $this->storeEmployeeService->searchEmployee('id', $id);
        $employee = $this->userService->buscarUser($storeEmployee->user_id);

        return view('employee.edit', ['employee' => $employee, 'employee_id' => $storeEmployee->id, 'store_id' => $storeEmployee->store_id]);
    }

    public function edit(Request $request){
        $this->storeEmployeeService->edit($request);

        return redirect("/employees/$request->store_id");
    }

    public function inactive($employee_id, $store_id){

        // dd($id, 'Controller');
        $this->storeEmployeeService->inactive($employee_id);

        return redirect("/employees/$store_id");
    }
}
