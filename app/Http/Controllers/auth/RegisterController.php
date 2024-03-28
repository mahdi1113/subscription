<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register(StoreUserRequest $StoreUserRequest)
    {
        $data = $StoreUserRequest->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return response()->json(['msg' => 'کاربر با موفقیت ایجاد شد']);
    }
}
