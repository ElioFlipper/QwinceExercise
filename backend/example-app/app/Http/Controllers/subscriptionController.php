<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class subscriptionController extends Controller
{
    public function getSubscription()
    {
        $subscriptions = Subscription::all();
        return response()->json($subscriptions);
    }

    public function getSingleSubscription($id) {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }
        return response()->json($subscription);
    }

    public function createSubscription(Request $request)
    {

        $startingDate = Carbon::parse($request->start_date)->toDateString();
        $endingDate = Carbon::parse($request->end_date)->toDateString();
        
        $subscription = Subscription::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'duration' => $request->duration,
            'startingDate' => $startingDate,
            'endingDate' => $endingDate
        ]);

        return response()->json($subscription, 201);
    }

    public function deleteSubscription(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        return response()->json(['message' => 'Subscription deleted']);
    }

    public function modifySubscription(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());
        return response()->json(['message' => 'Subscription modified']);
    }
}