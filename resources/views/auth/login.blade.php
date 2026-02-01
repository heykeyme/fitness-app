@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">Fitness Login</h2>
    
    <form id="loginForm" method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
            Login
        </button>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Forgot your password?</a>
        </p>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register here</a>
        </p>
    </form>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        if (!email.includes('@')) {
            e.preventDefault();
            alert('Please enter a valid email address.');
        }
    });
</script>
@endsection