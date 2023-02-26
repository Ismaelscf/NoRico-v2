<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function invoice(){
        DB::table('sales')
        ->select('user_id', DB::raw('SUM(total_sale) AS total_sale'), DB::raw('SUM(discount) AS discount'))
        ->where('sale_date', '<=', '2023-03-01')
        ->groupBy('user_id')
        ->get();
    }
}