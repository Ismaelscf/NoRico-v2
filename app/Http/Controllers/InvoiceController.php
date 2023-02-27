<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(){
        $actors = $this->invoiceService->generateInvoiceBatch();

        // dd($actors[1]->user->payday);

        // $invoices = $this->invoiceService->getAll();

        // return view()
    }
}