<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function register (Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed:password_confirmation'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return response()->json([
            $user->only('id', 'name', 'email', 'created_at')
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function login (Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credential'
            ], 401);
        }

        $token = $user->createToken('$user->name-AuthToken')->plainTextToken;
        $user_id = $user->id;

        return response()->json([
            'token' => $token,
            'user_id' => $user_id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
