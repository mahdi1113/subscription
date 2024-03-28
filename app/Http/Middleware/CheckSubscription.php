<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); // Getting the current authenticated user
        $currentDate = Carbon::now(); // Getting the current date

        // Checking if the user doesn't have a subscription or the subscription has expired
        if (!$user->subscription_id || $user->expiration_date < $currentDate->format('Y-m-d')) {
            return $next($request); // Proceed with the request
        } else {
            return response()->json(['msg' => 'Dear user, you already have a subscription.']); // Returning a message indicating that the user already has a subscription
        }
    }
}
