<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'surname' => 'required|string',
            'city' => 'required|string',
            'date_of_submission' => 'date',
            'activationStatus' => 'required|boolean',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'is_admin' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $registerUserData['name'],
            'username' => $registerUserData['username'],
            'city' => $registerUserData['city'],
            'surname' => $registerUserData['surname'],
            'date_of_submission' => Carbon::now(),
            'activationStatus' => $registerUserData['activationStatus'],
            'is_admin' => $registerUserData['is_admin'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);


        return response()->json([
            'message' => 'User Created ',
        ]);
    }

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);
        $user = User::where('email', $loginUserData['email'])->first();
        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user(); // Ottieni l'utente autenticato

        if ($user) {
            $user->tokens()->delete(); // Elimina tutti i token dell'utente
        }

        return response()->json([
            "message" => "Logged out successfully"
        ]);
    }
}