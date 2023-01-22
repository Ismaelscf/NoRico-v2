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

    public function detail($user_id, $quota_id){
        try {
            $user = $this->userService->buscarUser($user_id);
            $quota = $this->quotaService->buscarQuota($quota_id);
            $installments = $this->installmentService->buscarParcelas($quota_id, $user_id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('installment.detail', compact('user','quota', 'installments'));
    }

    public function buscarDadosParcelas(Request $request){
        $user_id = $request->user;
        $quota_id = $request->quota;

        return $this->detail($user_id, $quota_id);
    }

    public function pay($id){ 
        try {
            $installment = $this->installmentService->pay($id);
            

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->detail($installment->user_id, $installment->quota_id);
    }
}
