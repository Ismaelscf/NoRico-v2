<?php

namespace App\Repositories;

use App\Models\Winner;

class WinnerRepository
{
    protected $winner;

    public function __construct(Winner $winner)
    {
        $this->winner = $winner;
    }
}