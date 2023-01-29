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
        $managers = $this->storeService->getAllManager();

        return view('store.index', ['stores' => $stores, 'managers' => $managers]);
    }

    public function create(Request $request){

        // dd($request, 'Controller');

        $this->storeService->create($request);
        
        return $this->index();
    }

    public function editForm($id){

        $store = $this->storeService->searchStore('id', $id);

        return view('store.edit', ['store' => $store]);
    }

    public function edit(Request $request){

        $store = $this->storeService->edit($request);

        return redirect('/store');
    }

    public function inactive($id){

        // dd($id, 'Controller');
        $this->storeService->inactive($id);

        return redirect('/store');
    }
}