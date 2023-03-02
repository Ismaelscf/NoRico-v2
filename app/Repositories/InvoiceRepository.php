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

    public function generateInvoiceUser($initial_date, $final_date){

        return $this->sale->select('sales.user_id', 'users.payday', DB::raw('SUM(total_sale) as total_sales'), DB::raw('SUM(discount) as total_discount'))
        ->join('users', 'users.id', '=', 'sales.user_id')
        ->join('actors', 'actors.user_id', '=', 'users.id')
        ->whereBetween('sale_date', [$initial_date, $final_date])
        ->where('total_sale', '>', 0)
        ->where('actors.function', '=', 'cliente')
        ->groupBy('sales.user_id', 'users.payday')
        ->orderBy('sales.user_id')
        ->get();

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