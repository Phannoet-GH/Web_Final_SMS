@extends('layouts.app')

@section('title', 'Student Registration - Simple Student Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

        <!-- Header Title matching Page 6 -->
        <div class="mb-3 text-center text-md-start">
            <h3 class="fw-bold text-dark mb-1 tracking-tight">Simple Student Management System</h3>
            <p class="text-muted small mb-0">SETEC Institute Academic Portal &bull; Student Onboarding</p>
        </div>

        <div class="app-card mb-5">
            <!-- Minimalist Card Header matching Page 6 -->
            <div class="minimal-header">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="header-badge mb-0">
                        <i class="fa-solid fa-user-plus"></i> New Enrollment
                    </span>
                </div>
                <h2>Student Registration</h2>
                <p>Complete the form below to register as a new student</p>
            </div>

            <!-- Form Body -->
            <div class="p-4 p-md-5">
                @if($errors->any())
                    <div class="alert-minimal alert-minimal-danger mb-4">
                        <div class="fw-semibold text-danger mb-1 small">Please resolve the following errors:</div>
                        <ul class="mb-0 ps-3 small text-danger">
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
                        <div class="form-section-title">
                            <i class="fa-regular fa-id-badge text-muted"></i>
                            <span>Personal Information</span>
                        </div>

                        <!-- Student Name -->
                        <div class="mb-3">
                            <label for="student_name" class="form-label">Student Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-user text-muted"></i>
                                </span>
                                <input
                                    type="text"
                                    name="student_name"
                                    id="student_name"
                                    class="form-control border-start-0 ps-1 @error('student_name') is-invalid @enderror"
                                    placeholder="Enter full name"
                                    value="{{ old('student_name') }}"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-envelope text-muted"></i>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control border-start-0 ps-1 @error('email') is-invalid @enderror"
                                    placeholder="student@example.com"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
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
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Academic Information Section -->
                    <div class="mb-4">
                        <div class="form-section-title">
                            <i class="fa-solid fa-graduation-cap text-muted"></i>
                            <span>Academic Information</span>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Enrollment Date -->
                            <div class="col-md-6">
                                <label for="enrollment_date" class="form-label">Enrollment Date</label>
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

                            <!-- Years Enrolled (Calculated Display) -->
                            <div class="col-md-6">
                                <label for="years_enrolled_display" class="form-label">Years Enrolled <span class="text-muted fw-normal">(Auto-calculated)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-clock text-muted"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="years_enrolled_display"
                                        class="form-control border-start-0 ps-1 bg-light text-secondary"
                                        placeholder="0.00 years"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Department Selection -->
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
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
                                    <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Select Department</option>
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
                        <div class="form-section-title">
                            <i class="fa-regular fa-file-lines text-muted"></i>
                            <span>Additional Information</span>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Notes / Remarks <span class="text-muted fw-normal">(Optional)</span></label>
                            <textarea
                                name="description"
                                id="description"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter any additional information or remarks about this student..."
                            >{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Form Action Buttons (Matching Page 6 Layout) -->
                    <div class="d-flex flex-wrap align-items-center gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Submit Registration</span>
                        </button>

                        <button type="reset" id="resetBtn" class="btn btn-outline-secondary px-3">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Reset Form</span>
                        </button>

                        <a href="{{ route('students.index') }}" class="btn btn-teal ms-auto px-4">
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
