<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SenhaController extends Controller
{
    public function recuperarSenha()
    {
        dd('1');
        return view('user.password');
    }

    public function senha(Request $request)
    {
        dd('1',$request->all());
    }
}
