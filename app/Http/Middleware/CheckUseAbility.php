<?php

namespace App\Http\Middleware;

use App\Models\Abilitie;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUseAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); // Getting the current authenticated user
        $abilityId = $request->ability; // Getting the requested ability ID

        // Checking if the user has the requested ability
        $hasAbility = $user->abilitiesUser()
            ->where('ability_id', $abilityId)
            ->withPivot('count')
            ->first();

        // Getting the allowed usage for the requested ability
        $allowedUsage = Abilitie::whereId($request->ability)->pluck('allowed_usage')->first();

        if ($hasAbility) {
            // Checking if the user has exceeded the allowed usage for the ability
            if ($hasAbility->pivot->count > $allowedUsage) {
                return response()->json(['msg' => 'Your ability usage limit has been reached.']); // Returning a message indicating that the user has exceeded the ability usage limit
            } else {
                return $next($request); // Proceeding with the request
            }
        } else {
            return response()->json(['msg' => 'You do not have this ability.']); // Returning a message indicating that the user does not have the requested ability
        }

    }
}
