@extends('layouts.app')

@section('title', 'Login - Student Management System')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="app-card mb-3">
            <div class="p-4 p-sm-5">
                <!-- Branding Header matching Page 4 -->
                <div class="text-center mb-4">
                    <img src="{{ asset('LOGO-SETEC.ico') }}" alt="SETEC Logo" class="mx-auto mb-3 d-block" style="width: 56px; height: 56px; object-fit: contain;">
                    <h2 class="h4 fw-bold text-dark mb-1 tracking-tight">Login Form</h2>
                    <p class="text-muted small mb-0">Please enter your credentials to access the system</p>
                </div>

                @if($errors->any())
                    <div class="alert-minimal alert-minimal-danger mb-4">
                        <ul class="mb-0 ps-3 small text-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email', 'adminwoman@gmail.com') }}"
                            placeholder="adminwoman@gmail.com"
                            required
                            autofocus
                        >
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                        </div>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            value="password"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <!-- Remember me -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                        <label class="form-check-label text-muted small" for="remember">
                            Remember my login on this device
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <span>Login</span>
                        <i class="fa-solid fa-arrow-right fs-6"></i>
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-0">
                        Don't have an account yet?
                        <a href="{{ route('register') }}" class="text-dark fw-semibold text-decoration-underline ms-1">
                            Register Form
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Examiner Quick Credentials Hint Card -->
        <div class="app-card p-3 text-center bg-white">
            <div class="text-muted small" style="font-size: 0.78rem;">
                <i class="fa-solid fa-key text-warning me-1"></i>
                <strong>Default Credentials:</strong>
                <code class="text-dark bg-light px-1 py-0.5 rounded border ms-1">adminwoman@gmail.com</code> &bull; Password: <code class="text-dark bg-light px-1 py-0.5 rounded border">password</code>
            </div>
        </div>
    </div>
</div>
@endsection
