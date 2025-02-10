<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // اگر کاربر در صفحه لاگین است، بررسی نکنیم
        if (!$request->is('*AdminPanel*')) {
            return $next($request);
        }
        else{
            dd(session()->all());
             if (!session()->has('user_role')) {
            return redirect()->route('Login.index')->with('error', 'لطفاً ابتدا وارد شوید!');
        }

        }

        // بررسی اینکه آیا مقدار user_role در سشن وجود دارد یا نه

        return $next($request);
    }
}
