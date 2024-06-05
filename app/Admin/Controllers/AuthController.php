<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Log;
use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    public function postLogin(Request $request)
    {
        $md5 = 0;
        if($request->has('refresh_token')) {
            if(SiasnController::token_sso($request->refresh_token)) {
                $password = Administrator::where('username', $request->username)->select('password_x')->first();
                $request->merge(['password' => $password->password_x]);
                $md5 = 1;
            }
        }

        $this->loginValidator($request->all())->validate();

        // $users = Administrator::where('username', $request->username)->where('password_x', md5($request->password))->first();
        // if(isset($users)) {
        //     if(is_null($users->change_password)) {
        //         return view('admin.password_check', [
        //             'username' => $users->username,
        //             'pass' => $request->password,
        //             'jenis' => $request->jenis,
        //         ]);
        //     }
        // }
        
        $credentials = $request->only([$this->username(), 'password']);
        $credentials['password'] = ($md5 == 0) ? md5($credentials['password']) : $credentials['password'];
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

    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/logout?post_logout_redirect_uri=https://kepegawaian.anri.go.id/siap/');
    }
}
