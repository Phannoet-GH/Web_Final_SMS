@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5">
        <div class="app-card border-0 shadow-sm">
            <div class="p-4 p-md-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark mb-1">Register Form</h2>
                    <p class="text-muted small">Create your account to manage the student database</p>
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

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-secondary fw-semibold small">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="please input your name"
                            required
                            autofocus
                        >
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary fw-semibold small">Email address</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="adminwoman@gmail.com"
                            required
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
                            placeholder="•••••"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fs-6">
                        Register
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                            Login Form
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
