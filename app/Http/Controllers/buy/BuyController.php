<?php

namespace App\Http\Controllers\buy;

use App\Http\Requests\StoreBuyRequest;
use App\Models\Abilitie;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function store(StoreBuyRequest $request)
    {
        $data = $request->validated(); // Validated data from the request
        $abilityIds = Abilitie::where('subscription_id', $data['subscription_id'])->pluck('id'); // Retrieving ability IDs based on the subscription ID

        $user = Auth::user(); // Getting the current authenticated user

        $user->update([
            'subscription_id' => $data['subscription_id'], // Updating user's subscription ID
            'expiration_date' => $data['expiration_date'], // Updating user's subscription expiration date
        ]);

        $user->abilitiesUser()->attach($abilityIds); // Attaching abilities to the user

        return response()->json(['msg' => 'Subscription purchased successfully.']); // Returning a success message

    }
}
