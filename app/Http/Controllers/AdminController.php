<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\Feedback;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showPlans()
    {
        $plans = MembershipPlan::all();
        return view('admin.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $plan = MembershipPlan::create($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => 'Created a new membership plan: ' . $plan->name,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Plan created successfully.');
    }

    public function showAnnouncements()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement = Announcement::create($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => 'Created a new announcement: ' . $announcement->title,
        ]);

        return redirect()->route('admin.announcements')->with('success', 'Announcement created successfully.');
    }

    public function showFeedback()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function showActivityLog()
    {
        $logs = ActivityLog::with('user')->latest()->get();
        return view('admin.activity-log', compact('logs'));
    }
}
