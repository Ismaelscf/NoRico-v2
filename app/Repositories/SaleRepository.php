<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    protected $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
}