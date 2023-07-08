<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {}

    public function retrieveByToken($identifier, $token)
    {}

    public function updateRememberToken(Authenticatable $user, $token)
    {}

    public function retrieveByCredentials(array $credentials)
    {
        // Use $credentials to get the user data, and then return an object implements interface `Illuminate\Contracts\Auth\Authenticatable` 
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Verify the user with the username password in $ credentials, return `true` or `false`
    }
}