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

    public function index($result = null){
        $invoices = $this->invoiceService->getAllInvoices();

        // dd($invoices);

        return view('invoice.index', ['invoices' => $invoices, 'result' => $result]);
    }

    public function create(){
        $result = $this->invoiceService->generateInvoiceBatch();
        
        return redirect('/invoices')->with('result', $result);
    }
}