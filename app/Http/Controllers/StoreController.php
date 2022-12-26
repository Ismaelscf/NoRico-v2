<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\AddressService;

class StoreController extends Controller
{

    protected $storeService;
    protected $addressService;

    public function __construct(StoreService $storeService, AddressService $addressService)
    {
        $this->storeService = $storeService;
        $this->addressService = $addressService;
    }

    public function index(){
        $stores = $this->storeService->getAll();

        return view('store.index', ['stores' => $stores]);
    }

    public function create(Request $request){

        // dd($request, 'Controller');

        $this->storeService->create($request);
        
        return $this->index();
    }
}