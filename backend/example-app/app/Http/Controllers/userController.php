<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }
        return response()->json($user);
    }

    public function register(Request $request)
    {
        $user = User::create([
            '_token' => "RbghJfKTMHbqkPuvCmqiTW4tW2x5MGiARo6L1nBK",
            'username' => $request->username,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'city' => $request->city,
            'activationStatus' => $request->activationStatus,
            'date_of_submission' => Carbon::now()
        ]);
        return response()->json($user, 201);
    }
}
