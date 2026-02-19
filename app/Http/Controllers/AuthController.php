<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4|max:15|confirmed',
        ]);
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $user->password = Hash::make($validated['password']);


        try {
            $user->save();
            return response()->json($user); 

        } catch (\Exception $exception) {
            return response()->json([
                'Error' => 'Registration failed.',
                'Message' => $exception->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ]);

        try {
            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'error' => ['The provided credentials are incorrect.'],
                ], 401);
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Login Successful!',
                'user' => $user,
                'token' => $token,
      
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'Error' => 'Invalid Credentials.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Log Out Successful.'
        ]);
    }
}
