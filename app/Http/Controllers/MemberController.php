<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $subscription = $user->subscriptions()->where('status_id', 1)->latest()->first();
        $announcements = Announcement::latest()->take(5)->get();
        $activities = ActivityLog::where('user_id', $user->id)->latest()->take(5)->get();
        $upcomingClasses = $user->fitnessClasses()->where('date', '>=', now())->orderBy('date')->orderBy('time')->get();

        return view('member.dashboard', compact('user', 'subscription', 'announcements', 'activities', 'upcomingClasses'));
    }

    public function showPlans()
    {
        $plans = MembershipPlan::all();
        return view('member.plans', compact('plans'));
    }

    public function showFeedbackForm()
    {
        return view('member.feedback');
    }
}
