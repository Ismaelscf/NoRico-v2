<?php

namespace App\Services;

use App\Repositories\InstallmentRepository;
use App\Repositories\QuotaRepository;
use App\Repositories\UserQuotaRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class QuotaService
{
    protected $quotaRepository, $installmentRepository, $userQuotaRepository;

    public function __construct(QuotaRepository $quotaRepository, InstallmentRepository $installmentRepository, UserQuotaRepository $userQuotaRepository)
    {
        $this->quotaRepository = $quotaRepository;
        $this->installmentRepository = $installmentRepository;
        $this->userQuotaRepository = $userQuotaRepository;
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }
    
    public function create($dados)
    {
        // dd($dados->all());
        try {
            $quota['description'] = $dados->description;
            $quota['total_price'] = $this->removeMask($dados->total_price);
            $quota['initial_date'] = $dados->initial_date;
            $quota['final_date'] = $dados->final_date;
            $quota['customer_limit'] = $this->removeMask($dados->customer_limit);

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
            $quota->total_price = $this->removeMask($dados->total_price);
            $quota->initial_date = $dados->initial_date;
            $quota->final_date = $dados->final_date;
            $quota->customer_limit = $this->removeMask($dados->customer_limit);

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

    public function installments($dados, $user){

        try {
            $quota = $this->quotaRepository->search($dados->quota);
            $data_atual = Carbon::now()->createMidnightDate();
            $dt_final_cota = Carbon::createMidnightDate($quota->final_date);
            $dif = $data_atual->floatDiffInMonths($dt_final_cota);

            if(is_int($dif)){
                $parcelas = intval($dif)+1;
            }
            else {
                $parcelas = intval($dif)+2;
            }
            $dataIni = Carbon::now()->createMidnightDate();
            $dataVer = $dataIni->addMonths($parcelas);
            if($dataVer->greaterThan($dt_final_cota)){
                $parcelas = $parcelas-1;
            }
            // dd($dados->all());
            // dd($dt_final_cota->toDateString(),$parcelas,$data_atual->toDateString(),$dataVer->toDateString());
            $userQuota['user_id'] = $dados->user;
            $userQuota['quota_id'] = $dados->quota;
            $userQuota['initial_date'] = Carbon::now()->createMidnightDate()->toDateString();
            $userQuotaSave =  $this->userQuotaRepository->create($userQuota);
            // dd($userQuotaSave->id, 'teste');


            $dt_ini = Carbon::create(date('Y'), date('m'), $user->payday, 0);

            for ($i = 0; $i < $parcelas; $i++) {
                $installment['quota_id'] = $quota->id;
                $installment['user_id'] = $dados->user;
                $installment['seller_id'] = $dados->seller;
                $installment['user_quotas_id'] = $userQuotaSave->id;
                $installment['price'] = $quota->total_price/$parcelas;
                $installment['due_date'] = $dt_ini->addMonths($i)->toDateString();
                $dt_ini->subMonths($i)->toDateString();
                $installmentSave = $this->installmentRepository->create($installment);
            }

            $userQuotaSave->final_date = $installmentSave->due_date;
            $this->userQuotaRepository->edit($userQuotaSave);
            // dd($teste);
            $msg = 'Plano Contratado';
            return $msg;

        }  catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }
    }

}