<?php

namespace App\Repositories;

use App\Models\Quota;

class QuotaRepository
{
    protected $quota;

    public function __construct(Quota $quota)
    {
        $this->quota = $quota;
    }
}