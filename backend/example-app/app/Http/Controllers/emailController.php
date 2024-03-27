<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function mailSender(Request $request)
    {
        $username = $request->query('username');
        $name = $request->query('name');
        $surname = $request->query('surname');
        $city = $request->query('city');
        $email = $request->query('email');
        $activationStatus = $request->query('activationStatus');

        Mail::send('emails.email', [
            'username' => $username,
            'name' => $name,
            'surname' => $surname,
            'city' => $city,
            'activationStatus' => $activationStatus,
        ], function ($message) use ($email) {
            $message->to($email)->subject('Conferma dati');
        });
        
        return view('test-email');

    }


}
