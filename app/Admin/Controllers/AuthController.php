<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrator;

use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $users = Administrator::where('username', $request->username)->where('password_x', md5($request->password))->first();
        if(isset($users)) {
            if(is_null($users->change_password)) {
                return view('admin.password_check', [
                    'username' => $users->username,
                    'pass' => $request->password,
                    'jenis' => $request->jenis,
                ]);
            }
        }

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        if($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    public function postPeriod(Request $request)
    {
        $users = Administrator::where('username', $request->username)->first();
        $password = md5($request->password);
        $users->password_x = $password;
        $users->change_password = date('Y-m-d H:i:s', time());
        $users->save();
        
        return redirect()->back()->with('success', 'Password berhasil diperbarui. Silakan login kembali');
    }
}
