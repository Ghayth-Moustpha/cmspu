<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Generate JWT token for the registered user
        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request, $type)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role === $type) {
                $expiration = Carbon::now()->addDays(7); // Set the expiration to 7 days from now
                $token = $user->createToken('ACCESSTOKEN', ['expires_at' => $expiration]);
    
                return response()->json([
                    'user' => $user,
                    'token' => $token->plainTextToken,
                ]);
            } else {
                return response()->json(['error' => 'Invalid user type'], 401);
            }
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    public function logout()
    {
        // Invalidate the current token
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}