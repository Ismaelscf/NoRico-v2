<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Exception;


class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function index()
    {   
        return view('user.index');
    }

    public function create(Request $request)
    {
        $dados = $request->all();
        try {
            $msg = $this->userService->create($dados);
            // dd('1');

        } catch (Exception $exception) {
            // dd('contro');
            return view('user.index', [
                'msg' =>$exception->getMessage()
            ]);
        }

        return view('user.index', compact('msg'));
        // return redirect()->route('newUser');
    }

}
