<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Loan;
use App\Models\User;
use App\Models\Region;
use App\Models\LoanInstallment;
use Illuminate\Support\Facades\Auth;
use App\Services\HomeService;

class HomeController extends Controller
{
    protected $homeService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeService $homeService)
    {
        $this->middleware('auth');
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $dados = $this->homeService->home();
        return view('home', ['dados' => $dados]);
    }
}
