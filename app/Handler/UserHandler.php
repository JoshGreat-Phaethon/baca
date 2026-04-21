<?php

namespace App\Handler;

use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Hash;
use Exception;


class UserHandler
{
    protected UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        

        return $this->userRepo->createUser([
         'name' => $data['name'], 
         'email' =>$data['email'],
         'password'=> Hash::make($data['password']),
         

        ]);

        
        
    }

   

    public function login($email,$password)
    {
        $user = $this->userRepo->getUserByEmail($email);

        if(!$user || !Hash::check($password,$user->password)) {
            throw new Exception('Email atau password salah');

        }
        $token = $user->createToken('Bearer-Token')->plainTextToken;
        return [
            'token' => $token,
            'user' => $user
        ];

    }    

    public function deleteAccount(int $userId)
    {
        $user = $this->userRepo->getUserById($userId);

        if(!$user) {
            throw new Exception('user tidak ditemukan');

            
        }
        if ($user->saldo > 0) {
            throw new Exception('saldo harus 0');
        }

        return $this->userRepo->deleteUser($userId);
    }
} 
 
        