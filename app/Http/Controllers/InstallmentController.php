<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\InstallmentService;
use App\Services\QuotaService;
use App\Services\UserService;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    protected $installmentService;
    protected $quotaService;
    protected $userService;

    public function __construct(InstallmentService $installmentService, QuotaService $quotaService, UserService $userService)
    {
        $this->installmentService = $installmentService;
        $this->quotaService = $quotaService;
        $this->userService = $userService;
    }
    
    public function index()
    {   
        $msg = null;
        return $this->home($msg);
    }

    public function home($msg){
        $quotas = $this->installmentService->BuscarCotasContratadas(Auth::user()->id);
        return view('installment.index', compact('quotas', 'msg'));
    }

    public function detail(Request $request){
        try {
            $user = $this->userService->buscarUser($request->user);
            $quota = $this->quotaService->buscarQuota($request->quota);
            $installments = $this->installmentService->buscarParcelas($request->quota, $request->user);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('installment.detail', compact('user','quota', 'installments'));
    }
}
