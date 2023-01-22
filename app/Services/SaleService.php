<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SaleService
{
    protected $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getAll($store_id = null){      
        return $this->saleRepository->getAll($store_id);
    }

    public function create(Request $request){
        dd($request);
    }
}