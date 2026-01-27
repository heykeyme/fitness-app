@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Checkout</h1>

        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">You are subscribing to the <span class="text-indigo-600">{{ $plan->name }}</span></h2>
            <p class="text-xl font-extrabold text-gray-800 mb-6">Price: ${{ $plan->price }}<span class="text-lg font-medium text-gray-500">/month</span></p>

            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">
                        Card Number
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card_number" type="text" placeholder="**** **** **** ****" required>
                </div>

                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry_date">
                            Expiry Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry_date" type="text" placeholder="MM/YY" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cvc">
                            CVC
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cvc" type="text" placeholder="***" required>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline">
                        Pay Now
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
