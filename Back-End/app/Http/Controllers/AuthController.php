<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;


class AuthController extends Controller
{   
   public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|string|email|unique:logins,email',
        'password' => 'required|string|min:6',
    ]);

    $admin = Login::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return response()->json([
        'message' => 'Admin created successfully',
        'data' => $admin,
    ], 201);
}

   public function login(Request $request)
{
    $fields = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = Login::where('email', $fields['email'])->first();

    if (!$user || !Hash::check($fields['password'], $user->password)) {
        return response(['message' => 'Invalid credentials'], 401);
    }

    // Generate token (if using Sanctum)
    $token = $user->createToken('apptoken')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
}

    // public function logout(Request $request)
    // {
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json(['message' => 'Logged out']);
    // }
}
