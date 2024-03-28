<?php

namespace App\Http\Controllers\subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with('abilities')->orderBy('created_at', 'desc')->get();
        // در صورتی که نیاز باشه اطلاعات به شکل خاصی برگرده می تونیم از مپ استفاده کنیم
        // مثل کد زیر
        // $formattedSubscriptions = $subscriptions->map(function ($subscription) {
        //     return [
        //         'title' => $subscription->title,
        //         'price' => $subscription->price,
        //         'abilities' => $subscription->abilities->map(function ($ability) {
        //             return [
        //                 'title' => $ability->title,
        //                 'allowed_usage' => $ability->allowed_usage,
        //             ];
        //         }),
        //     ];
        // });

        return response()->json(['subscriptions' => $subscriptions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        // در صورتی که به هر علتی یک خطای غیر قابل پیش بینی رخ دهد به شکل زیر می توانیم این مساله را هندل کنیم
        try {
            $data = $request->validated();
            Subscription::create($data);
            return response()->json(['msg' => 'اشتراک با موفقیت ایجاد شد']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'خطا  : '], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->all());
        return response()->json(['msg' => 'اشتراک با موفقیت آپدیت شد']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['msg' => 'اشتراک با موفقیت حذف شد']);
    }
}
