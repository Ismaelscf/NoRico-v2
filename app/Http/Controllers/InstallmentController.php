<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\InstallmentService;
use App\Services\QuotaService;
use App\Services\UserService;
use App\Services\UserQuotaService;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    protected $installmentService;
    protected $quotaService;
    protected $userService;
    protected $userQuotaService;

    public function __construct(InstallmentService $installmentService, QuotaService $quotaService, UserService $userService, UserQuotaService $userQuotaService)
    {
        $this->installmentService = $installmentService;
        $this->quotaService = $quotaService;
        $this->userService = $userService;
        $this->userQuotaService = $userQuotaService;
    }
    
    public function index()
    {   
        $msg = null;
        return $this->home($msg);
    }

    public function track_parcels($id){
        $quotas = $this->installmentService->BuscarCotasContratadas($id);
        $msg = null;
        $userQuotas = $this->userQuotaService->buscarCotas($id);
        return view('installment.index', compact('quotas', 'msg', 'userQuotas', 'id'));
    }

    public function track_quotas(Request $request){
        // dd($request->all());
        $user = $this->userService->buscarUser($request->user);
        $installments = $this->installmentService->BuscarUserQuotas($request->quota);
        $quota = $this->quotaService->buscarQuota($installments[0]->quota_id);


        return view('installment.detail', compact('user','quota', 'installments'));
        // return view('installment.detail', compact('user','quota', 'installments', 'userQuotas'));
    }

    public function home($msg){
        $quotas = $this->installmentService->BuscarCotasContratadas(Auth::user()->id);
        $userQuotas = $this->userQuotaService->buscarCotas(Auth::user()->id);
        return view('installment.index', compact('quotas', 'msg', 'userQuotas'));
    }

    public function detail($user_id, $quota_id){
        try {
            $user = $this->userService->buscarUser($user_id);
            $quota = $this->quotaService->buscarQuota($quota_id);
            $installments = $this->installmentService->buscarParcelas($quota_id, $user_id);
            $userQuotas = $this->userQuotaService->buscarCotas($user_id);
            // dd($userQuota);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }
        
        // dd($installments[0]->seller);
        return view('installment.detail', compact('user','quota', 'installments', 'userQuotas'));
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

    public function delay($id){ 
        try {
            $installment = $this->installmentService->delay($id);
        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->detail($installment->user_id, $installment->quota_id);
    }
}
