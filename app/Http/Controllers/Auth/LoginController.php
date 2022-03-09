<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected $maxAttempts      = 5;                           // ログイン試行回数を5回に設定
    protected $decayMinutes     = 1440;                        // ログインロックタイムを24時間に設定1440
    protected $redirectToTop    = RouteServiceProvider::TOP;   // リダイレクト先をオーナーログイン画面を設定
    protected $redirectToOwner  = RouteServiceProvider::OWNER; // リダイレクト先をオーナーログイン画面を設定

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:owner')->except('logout');
        $this->max_length = config('const.MAX_LENGTH');
        $this->password_regex = config('const.PASSWORD_REGIX');
    }

    // オーナーログイン画面表示
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

    // ログイン処理
    public function login(Request $request)
    {
        // 失敗数をチェック
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // バリデーションチェック
        $validator = $this->validator($request);

        // バリデーションでエラーの場合
        if ($validator->fails()) {
            return $this->loginFaild($request);
        }

        // 認証成功
        if ($this->attemptLoginOwner($request)) {
            $this->authenticated($request);
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $request->session()->push('user_type', $request->user_type);
            return $this->sendFailedLoginResponse($request);
        }

        // 認証失敗
        return $this->loginFaild($request);
    }

    // オーナーの認証処理
    private function attemptLoginOwner(Request $request)
    {
        $user_type = $request->user_type;
        return Auth::guard($user_type)->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    // 失敗数をIPのみでカウント
    protected function throttleKey(Request $request)
    {
        return $request->ip();
    }

    // 他のデバイス上のセッションを無効化
    private function authenticated(Request $request)
    {
        Auth::logoutOtherDevices($request->input('password'));
    }

    // ログインエラーの処理
    private function loginFaild(Request $request)
    {
        $this->incrementLoginAttempts($request);            // 失敗カウント
        return $this->sendFailedLoginResponse($request);    // 失敗メッセージ
    }

    // バリデーション
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            $this->username()   => 'required|string|email|max:'.$this->max_length,
            'password'          => 'required|string|regex:'.$this->password_regex,
        ]);
    }
}