<?php

namespace App\Handler;

use App\Repositories\UserRepo;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserHandler
{
    public function __construct(protected UserRepo $userRepo) {}

    public function register(array $data)
    {
        return $this->userRepo->createUser([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(string $email, string $password): array
    {
        $user = $this->userRepo->getUserByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            throw new Exception('Email atau password salah');
        }

        $token = $user->createToken('Bearer-Token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function deleteAccount(int $userId)
    {
        $user = $this->userRepo->getUserById($userId);

        if (! $user) {
            throw new Exception('user tidak ditemukan');
        }

        $user->tokens()->delete();

        return $this->userRepo->deleteUser($userId);
    }
}
