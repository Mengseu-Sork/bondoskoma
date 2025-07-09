<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Login::all()]);
    }

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
        $token = $user->createToken('apptoken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
public function update(Request $request, $id)
{
    $request->validate([
        'old_email' => 'required|email',
        'old_password' => 'required|string',
        'new_email' => 'required|email|unique:logins,email,' . $id,
        'new_password' => 'required|string|min:6',
    ]);
    $admin = Login::findOrFail($id);

    if ($admin->email !== $request->old_email || !Hash::check($request->old_password, $admin->password)) {
        return response()->json(['message' => 'Old email or password is incorrect.'], 401);
    }
    $admin->email = $request->new_email;
    $admin->password = Hash::make($request->new_password);
    $admin->save();
    return response()->json(['message' => 'Admin updated successfully']);
}

public function verifyCredentials(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $admin = Login::where('email', $request->email)->first();

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'message' => 'Credentials verified',
        'admin_id' => $admin->id,
    ]);
}


}
