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

    public function editForm($id){
        $sort = $this->sortService->searchSort('id', $id);
        $stores = $this->storeService->getAll();

        return view('sort.edit', ['sort' => $sort, 'stores' => $stores]);
    }
    
    public function edit(Request $request){
        $result = $this->sortService->edit($request);
        
        return $this->index($result);
    }

    public function inactive($id){

        // dd($id, 'Controller');
        $this->sortService->inactive($id);

        return redirect('/sort');
    }

    public function rewardPage($id){

        $sort = $this->sortService->searchSort('id', $id);


        return view('sort.rewardPage', ['sort' => $sort]);
    }
}
