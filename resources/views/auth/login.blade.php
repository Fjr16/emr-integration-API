@extends('layouts.guest')
@section('login-form')
<!-- Session Status -->
{{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" class="form-label">Username</label>
        <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
        @enderror    
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control form-control-lg @error('email') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
    </div>
   
    <div class="row justify-content-center mt-5 px-4">
        <button type="submit" class="btn btn-lg btn-primary">Log in</button>
    </div>
</form>
@endsection
