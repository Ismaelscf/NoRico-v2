<?php

namespace App\Http\Controllers;

use App\Services\SortService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Services\StoreService;

class SortController extends Controller
{
    protected $sortService;

    protected $storeService;

    public function __construct(SortService $sortService, StoreService $storeService)
    {
        $this->sortService = $sortService;
        $this->storeService = $storeService;
    }

    public function index($result = null){

        $sorts = $this->sortService->getAll();
        $stores = $this->storeService->getAll();

        return view('sort.index', ['sorts' => $sorts, 'stores' => $stores, 'result' => $result]);
    }

    public function create(Request $request){
        
        $result = $this->sortService->create($request);
        
        return $this->index($result);
    }
}
