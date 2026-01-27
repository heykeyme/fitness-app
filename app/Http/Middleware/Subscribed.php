<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Subscribed
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
        if (Auth::check()) {
            $user = Auth::user();
            $subscription = Subscription::where('user_id', $user->id)
                ->where('status_id', 1) // Active
                ->where('end_date', '>', now())
                ->first();

            if ($subscription) {
                return $next($request);
            }
        }

        return redirect()->route('plans')->with('error', 'You need an active subscription to access this page.');
    }
}
