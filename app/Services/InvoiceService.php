<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\ActorService;
use App\Services\SaleService;

class InvoiceService
{
    protected $invoiceRepository;
    protected $actorService;

    public function __construct(InvoiceRepository $invoiceRepository, ActorService $actorService)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->actorService = $actorService;
    }

    public function getAllInvoices($user_id = null){
        if(isset($user_id)){
            return $this->getAllInvoicesUser($user_id);
        } else{
            return $this->invoiceRepository->getAllInvoices();
        }
    }

    public function getAllInvoicesUser($user_id){
        return $this->invoiceRepository->getAllInvoicesUser($user_id);
    }

    public function handleStatusInvoinces(Request $request){}

    public function getInvoicesSales(Request $request){}

    public function generateInvoiceBatch(){

        $initial_date = date('Y-m-d', strtotime('first day of last month'));
        $final_date = date('Y-m-d', strtotime('last day of last month'));

        $users = $this->invoiceRepository->getInvoiceUserMonth($initial_date);

        $users = (array) json_decode($users);
        
        // dd($users);


        $invoices = $this->invoiceRepository->generateInvoiceUser($initial_date, $final_date);

        // dd($invoices);

        $percent_rico = 0.8;
        $percent_user = 0.2;

        DB::beginTransaction();

        try{
            foreach($invoices as $invoice){

                if(!in_array($invoice->user_id, $users)){
                    $save['user_id'] = $invoice->user_id;
                    $save['total_sale'] = $invoice->total_sales;
                    $save['discount'] = $invoice->total_discount;
                    $save['pay'] = $invoice->total_discount * $percent_rico;
                    $save['received'] = $invoice->total_discount * $percent_user;
                    $save['payday'] = date('Y')."-".date('m')."-".$invoice->payday;
                    $save['reference_date'] = $initial_date;
                    $save['status'] = 'fechada';

                    $invoiceSave = $this->invoiceRepository->createInvoice($save);

                    if($invoiceSave) {
                        //Sucesso!
                        DB::commit();
                    } else {
                        //Fail, desfaz as alterações no banco de dados
                        DB::rollBack();
                    }
                }
            }
        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $msg;
        }

        $msg = 'Faturas do mês '. date('m')-1 .' geradas com sucesso';
        return $msg;
    }
}