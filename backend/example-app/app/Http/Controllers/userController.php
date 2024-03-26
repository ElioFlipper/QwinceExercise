<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function filter(Request $request)
    {
        $users = User::orderBy('id', 'asc');

        if ($usernameFilter = $request->query('username')) {
            $users->where('username', 'like', '%' . $usernameFilter . '%');
        }
        
        if ($nameFilter = $request->query('name')) {
            $users->where('name', 'like', '%' . $nameFilter . '%');
        }

        if ($emailFilter = $request->query('email')) {
            $users->where('email', 'like', '%' . $emailFilter . '%');
        }

        if ($cityFilter = $request->query('city')) {
            $users->where('city', 'like', '%' . $cityFilter . '%');
        }

        if ($activationStatusFilter = $request->query('activationStatus')) {
            $users->where('activationStatus', 'like', '%' . $activationStatusFilter . '%');
        }

        $filteredUsers = $users->get();

        return response()->json($filteredUsers);
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

    public function modify(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json(['message' => 'Utente aggiornato con successo', 'user' => $user]);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Utente eliminato con successo']);
    }
}
