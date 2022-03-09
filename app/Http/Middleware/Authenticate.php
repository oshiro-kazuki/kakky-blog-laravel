<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->is('home*')) {
                return route('login');
            } elseif ($request->is('owner*')) {
                return route('owner.login');
            }
        }
    }
}
