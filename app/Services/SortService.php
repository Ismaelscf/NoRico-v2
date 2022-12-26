<?php

namespace App\Services;

use App\Repositories\SortRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SortService
{
    protected $sortRepository;

    public function __construct(SortRepository $sortRepository)
    {
        $this->sortRepository = $sortRepository;
    }
}