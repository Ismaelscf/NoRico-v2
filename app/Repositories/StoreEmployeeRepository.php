<?php

namespace App\Repositories;

use App\Models\StoreEmployee;

class StoreEmployeeRepository
{
    protected $storeEmployee;

    public function __construct(StoreEmployee $storeEmployee)
    {
        $this->storeEmployee = $storeEmployee;
    }
}