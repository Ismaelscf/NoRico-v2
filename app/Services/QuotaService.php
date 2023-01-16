<?php

namespace App\Services;

use App\Repositories\QuotaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class QuotaService
{
    protected $quotaRepository;

    public function __construct(QuotaRepository $quotaRepository)
    {
        $this->quotaRepository = $quotaRepository;
    }

    public function create($dados)
    {
        // dd($dados->all());
        try {
            $quota['description'] = $dados->description;
            $quota['total_price'] = $dados->total_price;
            $quota['initial_date'] = $dados->initial_date;
            $quota['final_date'] = $dados->final_date;
            $quota['customer_limit'] = $dados->customer_limit;

            $this->quotaRepository->create($quota);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Plano Criado';
        return $msg;        
    }

    public function buscarTodos()
    {
        $quotas = $this->quotaRepository->buscarTodos();
        return $quotas;
    }

    public function buscarQuota($id){
        try {
            $quota = $this->quotaRepository->search($id);
            return $quota;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function edit($dados)
    {
        try {
            $quota = $this->quotaRepository->search($dados->id);
            $quota->description = $dados->description;
            $quota->total_price = $dados->total_price;
            $quota->initial_date = $dados->initial_date;
            $quota->final_date = $dados->final_date;
            $quota->customer_limit = $dados->customer_limit;

            $this->quotaRepository->edit($quota);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Plano Atualizado';
        return $msg;
    }

    public function status($id){
        try {

            $quota = $this->quotaRepository->search($id);

            $quota->active = !$quota->active;

            return $this->quotaRepository->status($quota);

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

}