<?php

namespace App\Http\Controllers;
use App\Services\QuotaService;

use Illuminate\Http\Request;

class QuotaController extends Controller
{
    protected $quotaService;

    public function __construct(QuotaService $quotaService)
    {
        $this->quotaService = $quotaService;
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
        dd($id);
        try {
            $user = $this->quotaService->hiring($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->home($msg);
    }
}
