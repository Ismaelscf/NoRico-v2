<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index($result = null){

        $user = Auth::user();
        $permition = $user->actors->function;

        if($permition != 'admin'){
            $invoices = $this->invoiceService->getAllInvoices($user->id);
        } else {
            $invoices = $this->invoiceService->getAllInvoices();
        }

        // dd($invoices);

        return view('invoice.index', ['invoices' => $invoices, 'result' => $result, 'permition'=> $permition]);
    }

    public function create(){
        $result = $this->invoiceService->generateInvoiceBatch();
        
        return redirect('/invoices')->with('result', $result);
    }
}