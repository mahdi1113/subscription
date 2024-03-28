<?php

namespace App\Http\Controllers\abilitie;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbilitieRequest;
use App\Models\Abilitie;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AbilitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abilities = Abilitie::with('subscription')->orderBy('created_at', 'desc')->get();
        return response()->json(['abilities' => $abilities]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbilitieRequest $request)
    {
        $data = $request->validated();
        Abilitie::create($data);
        return response()->json(['msg' => 'قابلیت با موفقیت ایجاد شد']);
    }
}
