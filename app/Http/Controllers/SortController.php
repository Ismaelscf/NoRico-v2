<?php

namespace App\Http\Controllers;

use App\Services\SortService;
use App\Services\UserService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Services\StoreService;
use App\Services\SaleService;

class SortController extends Controller
{
    protected $sortService;
    protected $saleService;
    protected $storeService;
    protected $userService;

    public function __construct(SortService $sortService, StoreService $storeService, SaleService $saleService, UserService $userService)
    {
        $this->sortService = $sortService;
        $this->storeService = $storeService;
        $this->saleService = $saleService;
        $this->userService = $userService;
    }

    public function index($result = null){

        $sorts = $this->sortService->getAll();
        $stores = $this->storeService->getAll();

        return view('sort.index', ['sorts' => $sorts, 'stores' => $stores, 'result' => $result]);
    }

    public function create(Request $request){
        $result = $this->sortService->create($request);
        
        // return $this->index($result);
        return redirect('/sort')->with('result', $result);
    }

    public function editForm($id){
        $sort = $this->sortService->searchSort('id', $id);
        $stores = $this->storeService->getAll();

        return view('sort.edit', ['sort' => $sort, 'stores' => $stores]);
    }

    public function winner(Request $request){
        // dd($request->all());
        $sort = $this->sortService->search($request->id);
        if($sort->award){
            $user = $this->userService->buscarUser($sort->award);
            return view('sort.winner', compact('sort', 'user'));
        }
        else {
            $sort = $this->sortService->winner($request);
            $user = $this->userService->buscarUser($sort->award);
        }        

        // dd($user->name);
        
        return view('sort.winner', compact('sort', 'user'));
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
        $users = $this->saleService->buscarConcorrentes($sort);
        $ids = $users->pluck('id');

        return view('sort.rewardPage', compact('sort', 'users', 'ids'));
    }
}
