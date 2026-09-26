@extends('layouts.app')

@section('title', 'Student Registration - Simple Student Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <!-- Main Title as in Screenshot -->
        <h3 class="fw-bold text-dark mb-3 text-center text-md-start">
            Simple Student Management System
        </h3>

        <div class="app-card border-0 mb-5">
            <!-- Gradient Header Banner matching Page 6 -->
            <div class="gradient-header text-center">
                <div class="d-inline-flex align-items-center justify-content-center mb-2" style="font-size: 2rem;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2 class="h3 fw-bold text-white mb-1">Student Registration</h2>
                <p>Complete the form below to register as a new student</p>
            </div>

            <!-- Form Body -->
            <div class="p-4 p-md-5">
                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('students.store') }}" method="POST" id="studentRegistrationForm">
                    @csrf

                    <!-- 1. Personal Information Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3 text-primary fw-bold">
                            <i class="fa-solid fa-circle-user fs-5"></i>
                            <span>Personal Information</span>
                        </div>

                        <!-- Student Name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-user text-muted"></i>
                                </span>
                                <input
                                    type="text"
                                    name="student_name"
                                    id="student_name"
                                    class="form-control border-start-0 ps-1 @error('student_name') is-invalid @enderror"
                                    placeholder="Student Name"
                                    value="{{ old('student_name') }}"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-envelope text-muted"></i>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control border-start-0 ps-1 @error('email') is-invalid @enderror"
                                    placeholder="Email Address"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-venus-mars text-muted"></i>
                                </span>
                                <select
                                    name="gender"
                                    id="gender"
                                    class="form-select border-start-0 ps-1 @error('gender') is-invalid @enderror"
                                    required
                                >
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Gender</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Academic Information Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3 text-primary fw-bold">
                            <i class="fa-solid fa-building-columns fs-5"></i>
                            <span>Academic Information</span>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Enrollment Date -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-calendar-days text-muted"></i>
                                    </span>
                                    <input
                                        type="date"
                                        name="enrollment_date"
                                        id="enrollment_date"
                                        class="form-control border-start-0 ps-1 @error('enrollment_date') is-invalid @enderror"
                                        value="{{ old('enrollment_date', date('Y-m-d')) }}"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Years Enrolled (Calculated) -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-clock text-muted"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="years_enrolled_display"
                                        class="form-control border-start-0 ps-1 bg-light text-secondary"
                                        placeholder="Years Enrolled"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Department Selection -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-building text-muted"></i>
                                </span>
                                <select
                                    name="department_id"
                                    id="department_id"
                                    class="form-select border-start-0 ps-1 @error('department_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_id }}" {{ old('department_id') == $dept->department_id ? 'selected' : '' }}>
                                            {{ $dept->dept_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Additional Information Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3 text-primary fw-bold">
                            <i class="fa-solid fa-file-lines fs-5"></i>
                            <span>Additional Information</span>
                        </div>

                        <div class="mb-3">
                            <textarea
                                name="description"
                                id="description"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter any additional information about the student"
                            >{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="d-flex flex-wrap gap-2 pt-2">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 py-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Submit Registration</span>
                        </button>

                        <button type="reset" id="resetBtn" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 px-3 py-2">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Reset Form</span>
                        </button>

                        <a href="{{ route('students.index') }}" class="btn btn-teal ms-auto d-inline-flex align-items-center gap-2 px-4 py-2">
                            <i class="fa-solid fa-list-ul"></i>
                            <span>View Student List</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const enrollmentInput = document.getElementById('enrollment_date');
        const yearsDisplay = document.getElementById('years_enrolled_display');

        function calculateYears() {
            if (!enrollmentInput.value) {
                yearsDisplay.value = '';
                return;
            }
            const enrollDate = new Date(enrollmentInput.value);
            const now = new Date();
            const diffMs = now - enrollDate;
            const years = Math.abs(diffMs / (1000 * 60 * 60 * 24 * 365.25));
            yearsDisplay.value = years.toFixed(2) + ' years';
        }

        enrollmentInput.addEventListener('change', calculateYears);
        calculateYears();

        document.getElementById('resetBtn').addEventListener('click', function() {
            setTimeout(calculateYears, 50);
        });
    });
</script>
@endpush
