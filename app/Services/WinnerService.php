<?php

namespace App\Services;

use App\Repositories\WinnerRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class WinnerService
{
    protected $winnerRepository;

    public function __construct(WinnerRepository $winnerRepository)
    {
        $this->winnerRepository = $winnerRepository;
    }

    public function getTotalWinner(){
        return $this->winnerRepository->getTotalWinner();
    }
}