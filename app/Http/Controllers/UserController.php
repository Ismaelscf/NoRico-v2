<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\UploadImage;
use Exception;


class UserController extends Controller
{
    protected $userService;
    
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
        try {
            $msg = $this->userService->editUser($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->home($msg);
        }

        return $this->home($msg);
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
        $users = $this->userService->buscarTodosFuncionarios();
        // dd($users[1]);
        return view('user.index', compact('users', 'msg'));
    }

    public function formSimpleUser($msg = null){
        return view('user.formSimpleUser', compact('msg'));
    }

    public function createSimpleUser(Request $request)
    {
        try {
            $msg = $this->userService->createSimpleUser($request);

        } catch (Exception $exception) {
            $msg = $exception->getMessage();
            return $this->formSimpleUser($msg);
        }

        return $this->formSimpleUser($msg);
    }
}
