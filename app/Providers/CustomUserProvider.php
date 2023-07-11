<?php

namespace App\Providers;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return Administrator::findOrFail($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        $qry = Administrator::where('username', '=', $identifier)->where('remember_token', '=', $token);

        if ($qry->count() > 0) {
            $user = $qry->select('username', 'password_x')->first();

            $attributes = array(
                'Username' => $user->username,
                'Password' => $user->password_x,

            );

            return $user;
        }
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);

        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        return Administrator::where('username', $credentials['username'])->get()->first();
        // Use $credentials to get the user data, and then return an object implements interface `Illuminate\Contracts\Auth\Authenticatable` 
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->password_x == md5($credentials['password']);
        // Verify the user with the username password in $ credentials, return `true` or `false`
    }
}
