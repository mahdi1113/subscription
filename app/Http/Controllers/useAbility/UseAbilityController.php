<?php

namespace App\Http\Controllers\useAbility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UseAbilityController extends Controller
{
    public function useAbility(Request $request)
    {
        //do something
        $abilityId = $request->ability;
        $user = Auth::user();
        $user->abilitiesUser()->where('ability_id', $abilityId)->increment('count', 1);
        return response()->json(['msg' => 'فعالیت انجام شد']);
    }
}
