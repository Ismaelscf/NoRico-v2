<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Services\QuotaService;
use App\Services\UserService;
use App\Services\InstallmentService;

use Illuminate\Http\Request;

class QuotaController extends Controller
{
    protected $quotaService;
    protected $userService;
    protected $installmentService;

    public function __construct(QuotaService $quotaService, UserService $userService, InstallmentService $installmentService)
    {
        $this->quotaService = $quotaService;
        $this->userService = $userService;
        $this->installmentService = $installmentService;
    }

    public function index(){
        $msg = null;
        return $this->home($msg);
    }

    public function home($msg){
        $quotas = $this->quotaService->buscarTodos();
        return view('quota.index', compact('quotas', 'msg'));
    }

    public function edit($id){

        try {
            $quota = $this->quotaService->buscarquota($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('quota.edit', compact('quota'));
    }

    public function editQuota(Request $request){
        // dd($request->all());
        try {
            $msg = $this->quotaService->edit($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->home($msg);
    }

    public function mudarStatus($id){
        try {
            $msg = $this->quotaService->status($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->index();
    }

    public function create(Request $request)
    {
        // dd($request->all());
        try {
            $msg = $this->quotaService->create($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->home($msg);
    }

    public function hiring($id)
    {
        try {
            $user = $this->userService->buscarUser($id);
            $quotas = $this->quotaService->buscarTodos();
            if(count($quotas) == 0){
                return redirect()->route('quotas.index');
            }
        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('quota.hiring', compact('user', 'quotas'));
    }

    public function installments(Request $request)
    {
        try {
            $user = $this->userService->buscarUser($request->user);
            $quota = $this->quotaService->installments($request, $user);
            $quota = $this->quotaService->buscarQuota($request->quota);
            $installments = $this->installmentService->buscarparcelas($request->quota, $user->id);

            // dd($quota, $user, $quotas, $installments);
        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('installment.detail', compact('user','quota', 'installments'));
        // return view('quota.pay_installments', compact('user', 'quotas', 'installments'));
    }
}
