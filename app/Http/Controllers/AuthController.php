<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Authentication logic here
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($validated);

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

     public function login(Request $request)
    {
        // Authentication logic here
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user->name || !Hash::check($request->password, $user->password)) {

            return "Invalid credentials.";
        } else {
            $token = $user->createToken($user->name);

            return [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
        }
        return "login";
    }

     public function logout(Request $request)
    {
        // Authentication logic here
        $request->user()->tokens()->delete();
        return "you are logged out";
    }
}
