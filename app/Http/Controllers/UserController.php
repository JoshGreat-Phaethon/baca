<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handler\UserHandler;
use App\Models\User;
use App\Helpers\ResponseHelper;

class UserController extends Controller
{
    protected UserHandler $handler;

    public function __construct(UserHandler $handler)
    {
        $this->handler = $handler;
    }

    public function register(Request $request)
    {
        $user = $this->handler->register($request->all());

        return ResponseHelper::success('Register berhasil', $user);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->handler->login(
            $request->email,
            $request->password
        );

        return ResponseHelper::success('Login berhasil', $user);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseHelper::success('logout berhasil');
    }

   

    public function deleteAccount(Request $request)
    {
        $user = $request->user();
        
        $this->handler->deleteAccount($user->id);

        return ResponseHelper::success('akun berhasil dihapus');
    }
   
    
    


    
}

