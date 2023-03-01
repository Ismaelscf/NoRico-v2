<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    protected $invoice;
    protected $sale;

    public function __construct(Invoice $invoice, Sale $sale)
    {
        $this->invoice = $invoice;
        $this->sale = $sale;
    }

    public function generateInvoiceUser($user_id, $initial_date, $final_date){

        return $this->sale->select('user_id', DB::raw('SUM(total_sale) as total_sales'), DB::raw('SUM(discount) as total_discount'))
        ->where('user_id', '=', $user_id)
        ->whereBetween('sale_date', [$initial_date, $final_date])
        ->groupBy('user_id')
        ->get();;

        // return $this->sale->where('user_id', '=', $user_id)->where('sale_date', '>=', $initial_date)->where('sale_date', '<=', $final_date)->sum('total_sale')->sum('discount')->get();
    }

    public function invoice(){
        DB::table('sales')
        ->select('user_id', DB::raw('SUM(total_sale) AS total_sale'), DB::raw('SUM(discount) AS discount'))
        ->where('sale_date', '<=', '2023-03-01')
        ->groupBy('user_id')
        ->get();
    }
}