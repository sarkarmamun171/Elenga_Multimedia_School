<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:8',
        ]);

            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
                'message' => 'Registration successful',
                'user' => $user,
        ],201);
    }

    public function login(Request $request){
        $user = User::where('email', $request->email);
    }
}
