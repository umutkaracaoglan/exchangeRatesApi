<?php

namespace App\Http\Middleware;

use App\Models\UserActivityLogs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\TerminableInterface;

class UserActivityLog implements TerminableInterface
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user('api')) {
            $user_id = $request->user()->id;

            $userActivityLog = new UserActivityLogs();
            $userActivityLog->user_id = $user_id;
            $userActivityLog->endpoint = $request->getRequestUri();
            $userActivityLog->save();
        }
        return $next($request);
    }

    public function terminate(\Symfony\Component\HttpFoundation\Request $request, Response $response)
    {
        Log::info("Call endpoint: ".$request->getRequestUri() . "  ". $response->getStatusCode());
    }
}
