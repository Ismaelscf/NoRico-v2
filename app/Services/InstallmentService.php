<?php

namespace App\Services;

use App\Repositories\InstallmentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InstallmentService
{
    protected $installmentRepository;

    public function __construct(InstallmentRepository $installmentRepository)
    {
        $this->installmentRepository = $installmentRepository;
    }
}