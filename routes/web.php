<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Authenticated and Admin-only Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/plans', [AdminController::class, 'showPlans'])->name('admin.plans');
    Route::post('/admin/plans', [AdminController::class, 'storePlan'])->name('admin.plans.store');
    Route::get('/admin/announcements', [AdminController::class, 'showAnnouncements'])->name('admin.announcements');
    Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::get('/admin/feedback', [AdminController::class, 'showFeedback'])->name('admin.feedback');
    Route::get('/admin/activity-log', [AdminController::class, 'showActivityLog'])->name('admin.activity-log');
});

// Authenticated Member Routes
Route::middleware(['auth', 'subscribed'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/plans', [MemberController::class, 'showPlans'])->name('plans');
    Route::get('/feedback', [MemberController::class, 'showFeedbackForm'])->name('feedback.form');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

// Payment Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/checkout/{plan}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
});