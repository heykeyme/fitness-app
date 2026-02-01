<?php

namespace App\Http\Controllers;

use App\Models\FitnessClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = FitnessClass::where('date', '>=', now())->orderBy('date')->orderBy('time')->get();
        $bookedClassIds = Auth::user()->fitnessClasses()->pluck('fitness_classes.id')->toArray();
        return view('classes.index', compact('classes', 'bookedClassIds'));
    }

    public function book(Request $request, FitnessClass $class)
    {
        $user = Auth::user();
        if ($user->fitnessClasses()->where('fitness_class_id', $class->id)->exists()) {
            return back()->with('error', 'You have already booked this class.');
        }

        $user->fitnessClasses()->attach($class->id);

        return back()->with('success', 'You have successfully booked the class.');
    }
}