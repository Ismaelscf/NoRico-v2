<?php

namespace App\Services;

use App\Repositories\StoreEmployeeRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class StoreEmployeeService
{
    protected $storeEmployeeRepository;

    public function __construct(StoreEmployeeRepository $storeEmployeeRepository)
    {
        $this->storeEmployeeRepository = $storeEmployeeRepository;
    }
}