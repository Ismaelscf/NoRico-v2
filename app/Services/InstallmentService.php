<?php

namespace App\Services;

use App\Repositories\InstallmentRepository;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InstallmentService
{
    protected $installmentRepository;

    public function __construct(InstallmentRepository $installmentRepository)
    {
        $this->installmentRepository = $installmentRepository;
    }

    public function buscarParcelas($id, $user){
        try {
            $installment = $this->installmentRepository->search($id, $user);
            return $installment;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function buscarTodos()
    {
        try {
            $quotas = $this->installmentRepository->buscarTodos();
        return $quotas;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
        
    }

    public function BuscarCotasContratadas($id)
    {
        try {
            $quotas = $this->installmentRepository->BuscarCotasContratadas($id);
        return $quotas;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
        
    }

    public function BuscarUserQuotas($id)
    {
        // dd($id);
        try {
            $quotas = $this->installmentRepository->BuscarUserQuotas($id);
        return $quotas;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
        
    }

    public function pay($id){
        try {
            $installment = $this->installmentRepository->searchInstallment($id);
            $installment->payday = Carbon::now()->toDateTimeString();
            $installment->status = 'pago';
            $this->installmentRepository->edit($installment);
            return $installment;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

    public function delay($id){
        try {
            $installment = $this->installmentRepository->searchInstallment($id);
            $installment->payday = Carbon::now()->toDateTimeString();
            $installment->status = 'atraso';
            $this->installmentRepository->edit($installment);
            return $installment;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }
}