<?php

namespace App\Http\Controllers;

use App\Handler\UserHandler;
use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserHandler $handler) {}

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = $this->handler->register($data);

        return ResponseHelper::success($user, 'Register berhasil', 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            $user = $this->handler->login($data['email'], $data['password']);
        } catch (Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }

        return ResponseHelper::success($user, 'Login berhasil');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return ResponseHelper::success(null, 'logout berhasil');
    }

    public function deleteAccount(Request $request)
    {
        $this->handler->deleteAccount($request->user()->user_id);

        return ResponseHelper::success(null, 'akun berhasil dihapus');
    }
}
