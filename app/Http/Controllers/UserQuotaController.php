<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\InstallmentService;
use App\Services\QuotaService;
use App\Services\UserService;
use App\Services\UserQuotaService;
use Illuminate\Http\Request;

class UserQuotaController extends Controller
{
    protected $userQuotaService;
    protected $quotaService;
    protected $userService;
    protected $installmentService;

    public function __construct(UserQuotaService $userQuotaService, QuotaService $quotaService, UserService $userService, InstallmentService $installmentService)
    {
        $this->userQuotaService = $userQuotaService;
        $this->quotaService = $quotaService;
        $this->userService = $userService;
        $this->installmentService = $installmentService;
    }
    
    public function index()
    {   
        
    }

    public function track_parcels($id){
        
    }

    public function home($msg){
        
    }

    
}
