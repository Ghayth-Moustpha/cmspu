<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Enums\Role; 
class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::all();
            return response()->json(['users' => $users]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'An error occurred while retrieving the users'], 500);
        }
    } 
   
        public function show(Request $request, $id)
        {
            // Verify if the request has a valid token
            if (!$request->bearerToken()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            // Retrieve the authenticated user from the token
          //  $admin = Auth::user();
    
            // Check if the authenticated user is an admin
          //  if (!$admin || $admin->role !== 'Admin') {
           //     return response()->json(['error' => 'Unauthorized'], 401);
           // }
    
            // Retrieve the user with the given ID
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            return response()->json($user);
        }
    
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'role' => ['required', function ($attribute, $value, $fail) {
                    $roles = Role::getValues(); 
                    if (!in_array($value, $roles)) {
                        $fail('The ' . $attribute . " ". $value.' is invalid.');

                    }
                }],
            ]);
    
            // Create the user
            $user = User::createUser($validatedData);
    
            // Return a response or perform any additional actions
            return response()->json(['message' => 'User created successfully', 'user' => $user]);
        } catch (ValidationException $exception) {
            // Return validation error messages
            return response()->json(['errors' => $exception->errors()], 422);
        } catch (\Exception $exception) {
            // Return generic error message
            return response()->json(['error' => 'An error occurred while creating the user' , "data " => $exception->errors() ], 500);
        }
    }


}
