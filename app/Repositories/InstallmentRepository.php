<?php

namespace App\Repositories;

use App\Models\Installment;

class InstallmentRepository
{
    protected $installmente;

    public function __construct(Installment $installmente)
    {
        $this->installmente = $installmente;
    }
}