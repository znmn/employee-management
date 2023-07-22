<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => strtolower($request->input('email')),
                'password' => Hash::make($request->input('password')),
            ]);

            $token = $user->createToken(env('APP_KEY', 'Kunci-Token'))->plainTextToken;

            return response()->json([
                'message' => 'User created successfully',
                'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User registration failed!',
                'error' => $e->getMessage(),
            ], 400);
        }
    }


    /**
     * Login a user
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login credentials',
                ], 401);
            }

            $user = User::where('email', $request->input('email'))->firstOrFail();
            $token = $user->createToken(env('APP_KEY', 'Kunci-Token'))->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully',
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User login failed!',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Logout a user
     */
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                'message' => 'User logged out successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User logout failed!',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    /**
     * Unauthenticated user
     */
    public function unauthorized()
    {
        // redirect to index
        return redirect("/");
    }
}
