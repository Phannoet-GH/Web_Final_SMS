@extends('layouts.app')

@section('title', 'Register - Student Management System')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="app-card mb-3">
            <div class="p-4 p-sm-5">
                <!-- Branding Header matching Page 5 -->
                <div class="text-center mb-4">
                    <img src="{{ asset('LOGO-SETEC.ico') }}" alt="SETEC Logo" class="mx-auto mb-3 d-block" style="width: 56px; height: 56px; object-fit: contain;">
                    <h2 class="h4 fw-bold text-dark mb-1 tracking-tight">Register Form</h2>
                    <p class="text-muted small mb-0">Create an account to manage the student database</p>
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

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
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
                        <label for="email" class="form-label">Email address</label>
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
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <span>Register</span>
                        <i class="fa-solid fa-arrow-right fs-6"></i>
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-dark fw-semibold text-decoration-underline ms-1">
                            Login Form
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
