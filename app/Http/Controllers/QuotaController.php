<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotaController extends Controller
{
    public function index(){
        return view('quota.index');
    }
}
