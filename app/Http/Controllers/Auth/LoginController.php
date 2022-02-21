<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:owner')->except('ownerLogout');
    }

    public function showOwnerLoginForm()
    {
        $script = [
            'js/auth/login.js',
        ];
        
        return view(
            'auth.owner.login',
            [
                'authgroup'     => 'owner',
                'screen_title'  => 'ログイン画面',
                'script'        => $script
            ]
        );
    }

    public function ownerLogin(LoginRequest $request)
    {
        $login_data = $request->all();

        if (Auth::guard('owner')->attempt(['email' => $login_data['login_email'], 'password' => $login_data['login_password']], $request->get('remember'))) {
            Auth::logoutOtherDevices($request->input('login_password'));
            return redirect()->intended('owner/login');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function ownerLogout(Request $request)
    {
        Auth::guard('owner')->logout();

        Auth::logoutOtherDevices($request); // 他のデバイス上のセッションを無効化

        return redirect('owner/login');
    }
}