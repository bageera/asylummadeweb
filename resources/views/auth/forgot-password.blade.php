@extends('layouts.app')

@section('title', 'Reset Password — Asylum Made Track & Field')

@section('content')
<div class="min-vh-100 d-flex align-items-center py-5" style="background-color: var(--surface-soft);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <img src="/assets/images/icons/logo.png" alt="Asylum Made" height="48" class="mb-3">
                            <h1 class="h4 fw-bold">Reset Password</h1>
                            <p class="text-muted">Enter your email to receive a password reset link</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                Send Reset Link
                            </button>

                            <p class="text-center text-muted mb-0">
                                Remember your password? 
                                <a href="{{ route('login') }}">Sign in</a>
                            </p>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-muted small">&larr; Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection