<?php

namespace App\Http\Controllers;

use App\Services\SortService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class SortController extends Controller
{
    protected $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    public function index(){

        $sorts = $this->sortService->getAll();

        return view('sort.index', ['sorts' => $sorts]);
    }
}
