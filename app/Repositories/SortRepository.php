<?php

namespace App\Repositories;

use App\Models\Sort;

class SortRepository
{
    protected $sort;

    public function __construct(Sort $sort)
    {
        $this->sort = $sort;
    }
}