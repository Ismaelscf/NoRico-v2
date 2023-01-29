<?php

namespace App\Services;

use App\Repositories\UserQuotaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserQuotaService
{
    protected $userQuotaRepository;

    public function __construct(UserQuotaRepository $userQuotaRepository)
    {
        $this->userQuotaRepository = $userQuotaRepository;
    }

    public function buscarCotas($id)
    {
        try {
            $cotas = $this->userQuotaRepository->buscarCotas($id);
            

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
        return $cotas;
        
    }

    public function buscarCotasporPlano($id)
    {
        try {
            $cotas = $this->userQuotaRepository->buscarCotasporPlano($id);

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
        return $cotas;
        
    }
}