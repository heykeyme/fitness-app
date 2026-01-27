@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Choose Your Plan</h1>

        <div class="flex flex-wrap items-center justify-center gap-8">
            @foreach($plans as $plan)
                <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-sm text-center">
                    <h2 class="text-2xl font-bold text-gray-700">{{ $plan->name }}</h2>
                    <p class="text-4xl font-extrabold text-indigo-600 my-4">${{ $plan->price }}<span class="text-lg font-medium text-gray-500">/month</span></p>
                    <ul class="text-gray-600 mb-6">
                        <li class="py-2">{{ $plan->description }}</li>
                    </ul>
                    <a href="{{ route('payment.checkout', ['plan' => $plan->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                        Subscribe Now
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
