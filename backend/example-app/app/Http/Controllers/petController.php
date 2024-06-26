<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class PetController extends Controller
{

    public function storePet(Request $request, $id)
    {
        $pet = Pets::create([
            'name' => $request->name,
            'species' => $request->species,
            'user_id' => $id
        ]);
        return response()->json($pet, 201);
    }


    public function getPets()
    {
        $pets = Pets::all();
        return response()->json($pets);
    }


    public function getUsersPet($id)
    {
        $pets = Pets::where('user_id', $id)->get();
        if ($pets->isEmpty()) {
            return response()->json(['message' => 'Nessun animale domestico trovato per questo utente'], 404);
        }
        return response()->json($pets);
    }
}