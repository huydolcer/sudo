<?php


namespace App\Repositories;
use Illuminate\Support\Facades\Auth;

class UserRepository extends AbstractRepository
{
    protected function getModel()
    {
        return \App\Models\User::class;
    }

    public function findOrCreateUser($googleUser)
    {
        $user = $this->model->where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = $this->model->create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(bin2hex(random_bytes(8))),
            ]);
        }

        return $user;
    }

    public function login($user)
    {
        Auth::login($user, true);
    }


}