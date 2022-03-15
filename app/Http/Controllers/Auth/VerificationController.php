<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    private $guard;

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // メール認証画面表示
    public function show(Request $request)
    {
        if($request->session()->has('user_type')){
            $this->guard = $request->session()->pull('user_type', 'default')[0];
        }else{
            $request->session()->flush();
            return view('error.unauthorized_access');
        }

        if ($request->user($this->guard)->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }else{
            $request->user($this->guard)->sendEmailVerificationNotification(); // メール送信処理
            return view('auth.verify',
                [
                    'screen_title'  => 'メール認証画面',
                    'user_type'  => $this->guard,
                ]
            );
        }
    }

    // 再送信処理
    public function resend(Request $request)
    {
        $this->getReqestUserType($request->user_type); //ユーザータイプをガードに格納

        if ($request->user($this->guard)->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->session()->push('user_type', $this->guard);
        return back()->with('resent', true);
    }

    // 認証メール受信処理
    public function verify(Request $request)
    {
        $this->getReqestUserType($request->user_type); //ユーザータイプをガードに格納

        if (! hash_equals((string) $request->route('id'), (string) $request->user($this->guard)->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user($this->guard)->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user($this->guard)->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user($this->guard)->markEmailAsVerified()) {
            event(new Verified($request->user($this->guard)));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    // ユーザータイプチェック
    private function getReqestUserType($user_type)
    {
        if(isset($user_type)) $this->guard = $user_type;
    }
}