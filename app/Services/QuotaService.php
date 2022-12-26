<?php

namespace App\Services;

use App\Repositories\QuotaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class QuotaService
{
    protected $quotaRepository;

    public function __construct(QuotaRepository $quotaRepository)
    {
        $this->quotaRepository = $quotaRepository;
    }
}