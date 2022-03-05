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

    protected $guard;

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('auth:owner');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        if ($request->user($this->guard)->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }else{
            $request->user($this->guard)->sendEmailVerificationNotification();
            return view('auth.verify',
                [
                    'screen_title'  => 'メール認証画面',
                    'user_type'  => $this->guard,
                ]
            );
        }
    }

    public function verify(Request $request)
    {
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

    public function resend(Request $request)
    {
        if ($request->user($this->guard)->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        return back()->with('resent', true);
    }

    private function routeCheck($request)
    {
        if(isset($request->server()['HTTP_REFERER'])){
            $refere = $request->server()['HTTP_REFERER'];
            $domain = 'http://'.$request->server()['HTTP_HOST'];
            $route = str_replace($domain , '', $refere);

            if($request->session()->has('user_type')){
                $user_type = $request->session()->pull('user_type', 'default');
                if($route === '/owner/login' && $user_type[0] === '1'){
                    return 'owner';
                }
            }else{
                if($route === '/login'){
                }
            }
        }
        // return '';
        return redirect('/');
    }
}