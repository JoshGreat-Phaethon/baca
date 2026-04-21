<?php
namespace App\Repositories;
use App\Models\User;
use App\Interfaces\UserInterface;

class UserRepo  implements UserInterface
{
    public function getAllUsers()
    {
        return User::all();
    }
    public function getUserById($id)
    {
        return User::find($id);
    }
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    public function createUser(array $data)
    {
        return User::create($data);
    }
    public function updateUser($id, array $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}


 