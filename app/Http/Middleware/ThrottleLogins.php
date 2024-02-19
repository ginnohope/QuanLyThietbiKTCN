<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThrottleLogins
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $maxAttempts = 10; // Số lần nhập sai tối đa
        $decayMinutes = 2; // Khoảng thời gian giữa các lần thử

        if ($this->hasTooManyLoginAttempts($request, $maxAttempts, $decayMinutes)) {
            return $this->sendLockoutResponse($request, $decayMinutes);
        }

        $this->incrementLoginAttempts($request, $maxAttempts, $decayMinutes);

        return $next($request);
    }

    protected function hasTooManyLoginAttempts(Request $request, $maxAttempts, $decayMinutes)
    {
        return app(RateLimiter::class)->tooManyAttempts(
            $this->resolveRequest($request), $maxAttempts, $decayMinutes
        );
    }

    protected function resolveRequest(Request $request)
    {
        return sha1(
            $request->getMethod().'|'.$request->ip().'|'.$request->path().'|'.$request->input('email')
        );
    }

    protected function sendLockoutResponse($request, $decayMinutes)
    {
        $retryAfter = app(RateLimiter::class)->availableIn(
            $this->resolveRequest($request), $decayMinutes * 60
        );

        return back()->with('error', ' Bạn đã nhập quá lần thử, xin vui lòng đợi trong '.$retryAfter.' giây!');
    }

    protected function incrementLoginAttempts($request, $maxAttempts, $decayMinutes)
    {
        app(RateLimiter::class)->hit(
            $this->resolveRequest($request), $decayMinutes * 60
        );
    }
}
