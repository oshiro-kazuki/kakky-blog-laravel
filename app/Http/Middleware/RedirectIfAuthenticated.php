<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Owners;

class RedirectIfAuthenticated
{
    // ログイン成功時のリダイレクト
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard === 'owner' && Auth::guard($guard)->check()) {
            if(isset($request->session()->get('_old_input')['email'])){
                $email = $request->session()->get('_old_input')['email'];
                $os = $request->server('HTTP_SEC_CH_UA_PLATFORM');
                $os = str_replace('"', '', $os);
                $owner = new Owners;
                $owner->sendEmailLogin($email, $os); //ログイン成功のメール送信
                return redirect(RouteServiceProvider::OWNER);
            }
        }else if($guard === 'user' && Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
