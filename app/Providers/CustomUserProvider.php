<?php

namespace App\Providers;

use App\Models\Administrator;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {       
        return config('admin.database.users_model')::findOrFail($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        $qry = config('admin.database.users_model')::where('username', '=', $identifier)->where('remember_token', '=', $token);
        if($qry->count() > 0) {
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

    // Use $credentials to get the user data, and then return an object implements interface `Illuminate\Contracts\Auth\Authenticatable`
    public function retrieveByCredentials(array $credentials)
    {
        $jenis = request('jenis', 1);
        $user = null;
        if($jenis == 1) { //pin
            $user = config('admin.database.users_model')::whereHas('obj_employee', function($q) use($credentials) {
                $q->where('pin_absen', $credentials['username']);
            })->get()->first();
        }
        else if($jenis == 2){ //username
            $user = config('admin.database.users_model')::where('username', $credentials['username'])->get()->first();
        }
        else if($jenis == 3) { //email
            $user = config('admin.database.users_model')::whereHas('obj_employee', function($q) use($credentials) {
                $q->where('email_kantor', $credentials['username']);
            })->get()->first();
        }
        return $user;
    }

    // Verify the user with the username password in $credentials, return `true` or `false`
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->password_x == $credentials['password'];
    }
}
