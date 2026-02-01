@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">Reset Your Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input id="password" type="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="text-red-500 text-xs italic mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <input id="password-confirm" type="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
            Reset Password
        </button>
    </form>
</div>
@endsection
