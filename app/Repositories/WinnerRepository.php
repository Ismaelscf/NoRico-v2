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

    public function getTotalWinner(){
        dd($this->winner::all());
    }
}