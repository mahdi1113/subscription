<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response(
                [
                    'error' => 'we have error',
                ],
                401,
            );
        }

        $user = Auth::user();
        // $token = $user->createToken('main')->withAccessTokenExpires(Carbon::now()->addHours(2))->plainTextToken;

        $token = $user->createToken('main');

        // Retrieve the token instance
        $personalAccessToken = $token->accessToken;

        // Set the expiration time (e.g., 2 hours from now)
        $personalAccessToken->expires_at = Carbon::now()->addHours(5);

        // Save the token to update the expires_at field
        $personalAccessToken->save();

        return response(['token' => $token->plainTextToken], 200);
    }
}
