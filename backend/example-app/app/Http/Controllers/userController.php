<?php

namespace App\Http\Controllers;

use App\Mail\userRegister;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\userRegistrationNotify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


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
            $users->where('name', 'like', '%' . $nameFilter . '%')
                ->orWhere('surname', 'like', '%' . $nameFilter . '%');
        }

        if ($emailFilter = $request->query('email')) {
            $users->where('email', 'like', '%' . $emailFilter . '%');
        }

        if ($cityFilter = $request->query('city')) {
            $users->where('city', 'like', '%' . $cityFilter . '%');
        }

        if ($activationStatusFilter = $request->query('activationStatus')) {
            $users->where('activationStatus', $activationStatusFilter);
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

        Notification::sendNow($user, new userRegistrationNotify($user));

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

    // public function mailSender(Request $request)
    // {
    //     $email = $request->query('email');
    //     $user = User::where('email', $email)->first();
    //     $notification = new userRegister($user);
    //     Mail::to($email)->send($notification);
    // }

    public function addSubscriptionToUser($userId, $subscriptionId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }
        $user->subscriptions()->attach($subscriptionId);
        return response()->json(['message' => 'Relazione aggiunta con successo']);
    }

    public function removeSubscriptionFromUser($userId, $subscriptionId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }
        $user->subscriptions()->detach($subscriptionId);
        return response()->json(['message' => 'Relazione rimossa con successo']);
    }

    public function getUsersSubscriptions($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }

        $subscriptions = $user->subscriptions;

        if ($subscriptions->isEmpty()) {
            return response()->json(['message' => 'Nessuna relazione trovata per questo utente'], 404);
        }

        return response()->json($subscriptions);
    }

    public function getUsersBySubscription($subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            return response()->json(['message' => 'Sottoscrizione non trovata'], 404);
        }

        $users = $subscription->users;

        if ($users->isEmpty()) {
            return response()->json(['message' => 'Nessun utente trovato per questa sottoscrizione'], 404);
        }

        return response()->json($users);
    }

    public function post(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10048',
        ]);
        
        $path = $request->file('file')->store('public/files');
        
        Log::info("la madonna");
        return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);
    }


}