<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\Feedback;
use App\Models\MembershipPlan;
use App\Models\FitnessClass;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalMembers = User::where('role_id', 2)->count();
        $totalSubscriptions = Subscription::count();
        $totalRevenue = Payment::sum('amount');

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $newMembersThisMonth = User::where('role_id', 2)
                                   ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                                   ->count();
        
        $announcements = Announcement::latest()->take(5)->get();

        $activityLogs = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalMembers', 'totalSubscriptions', 'totalRevenue', 'newMembersThisMonth', 'announcements', 'activityLogs'));
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

        $plan = MembershipPlan::create([
            'plan_name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'duration_days' => 30, // default to 30 days
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created a new membership plan: ' . $plan->plan_name,
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement = Announcement::create($validatedData);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created a new announcement: ' . $announcement->title,
        ]);

        return redirect()->route('admin.announcements')->with('success', 'Announcement created successfully.');
    }

    public function showClasses()
    {
        $classes = FitnessClass::orderBy('date')->orderBy('time')->get();
        return view('admin.classes', compact('classes'));
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        FitnessClass::create($request->all());

        return back()->with('success', 'Class created successfully.');
    }

    public function destroyClass(FitnessClass $class)
    {
        $class->delete();

        return back()->with('success', 'Class deleted successfully.');
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
