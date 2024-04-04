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


        $token = $user->createToken('token')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($loginUserData)) {
            $token = auth()->user()->createToken('token')->accessToken;
            return response()->json(['token' => $token], 200);

        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
        }

        return response()->json([
            "message" => "Logged out successfully"
        ]);
    }
}