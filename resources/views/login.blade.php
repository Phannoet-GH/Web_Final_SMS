@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5">
        <div class="app-card border-0 shadow-sm">
            <div class="p-4 p-md-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark mb-1">Login Form</h2>
                    <p class="text-muted small">Please enter your credentials to access the system</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                        <ul class="mb-0 ps-3">
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
                        <label for="email" class="form-label text-secondary fw-semibold small">Email address</label>
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
                    <div class="mb-4">
                        <label for="password" class="form-label text-secondary fw-semibold small">Password</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            value="password"
                            placeholder="•••••"
                            required
                        >
                    </div>

                    <!-- Remember me & Submit -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                            <label class="form-check-label small text-secondary" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fs-6">
                        Login
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-0">
                        Don't have an account yet?
                        <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">
                            Register Form
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Credentials Hint for Examiner -->
        <div class="card mt-3 border-0 bg-white shadow-sm p-3 rounded-3 text-center">
            <small class="text-muted">
                <i class="fa-solid fa-key text-warning me-1"></i>
                <strong>Default Credentials:</strong>
                <code>adminwoman@gmail.com</code> &bull; Password: <code>password</code>
            </small>
        </div>
    </div>
</div>
@endsection
