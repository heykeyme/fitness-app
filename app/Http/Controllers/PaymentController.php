<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout(MembershipPlan $plan)
    {
        return view('payment.checkout', compact('plan'));
    }

    public function process(Request $request)
    {
        $plan = MembershipPlan::findOrFail($request->plan_id);
        $user = Auth::user();

        // 1. Create a Payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'membership_plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_method_id' => 1, // Assuming 1 for 'Credit Card'
            'status_id' => 1, // Assuming 1 for 'Success'
            'transaction_ref' => 'txn_' . uniqid(),
        ]);

        // 2. Create a Subscription record
        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addMonth(), // Assuming a monthly plan
            'status_id' => 1, // Assuming 1 for 'Active'
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Subscription activated successfully!');
    }
}
