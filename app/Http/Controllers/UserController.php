<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\UploadImage;
use Exception;


class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function index()
    {   
        $msg = null;
        return $this->home($msg);
        
    }

    public function create(Request $request)
    {
        try {
            $msg = $this->userService->create($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->home($msg);
    }

    public function edit($id){

        try {
            $user = $this->userService->buscarUser($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('user.edit', compact('user'));
    }

    public function editUser(Request $request){
        // dd($request->all());
        try {
            $user = $this->userService->editUser($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return view('user.edit', compact('user'));
    }

    public function mudarStatus($id){
        try {
            $msg = $this->userService->status($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->index();
    }

    public function status($id){
        try {
            $this->userService->status($id);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->index();
    }

    public function home($msg){
        $users = $this->userService->buscarTodos();
        return view('user.index', compact('users', 'msg'));
    }
}
