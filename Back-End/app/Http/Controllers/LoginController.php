<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Login  ;
 use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
        public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|string|email|unique:admins,email',
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
}
