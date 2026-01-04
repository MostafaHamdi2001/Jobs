<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (auth()->attempt($request->only('email', 'password'))) {
        $user = \App\Models\User::find(auth()->user()->id);
        

        $token = $user->createToken('LaravelPassportToken')->accessToken;

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user
        ], 200);
        
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}
}
