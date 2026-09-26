@extends('layouts.app')

@section('title', 'Student Profile - ' . $student->student_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="app-card border-0 mb-4">
            <div class="gradient-header text-center">
                <div class="d-inline-flex align-items-center justify-content-center mb-2" style="font-size: 2.5rem;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2 class="h3 fw-bold text-white mb-1">Student Profile</h2>
                <p>Detailed record for {{ $student->student_name }}</p>
            </div>

            <div class="p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-2" style="width: 72px; height: 72px; font-size: 2rem;">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-0">{{ $student->student_name }}</h4>
                    <span class="badge bg-secondary-subtle text-secondary mt-1">Student ID: #{{ $student->student_id }}</span>
                </div>

                <div class="list-group list-group-flush rounded-3 border mb-4">
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted"><i class="fa-regular fa-envelope me-2 text-primary"></i> Email Address</span>
                        <span class="fw-semibold text-dark">{{ $student->email }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted"><i class="fa-solid fa-venus-mars me-2 text-primary"></i> Gender</span>
                        <span class="fw-semibold text-dark">{{ $student->gender }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted"><i class="fa-regular fa-calendar-days me-2 text-primary"></i> Enrollment Date</span>
                        <span class="fw-semibold text-dark">{{ $student->enrollment_date ? $student->enrollment_date->format('F d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted"><i class="fa-regular fa-clock me-2 text-primary"></i> Duration Enrolled</span>
                        <span class="fw-semibold text-primary">{{ $student->years_enrolled_decimal }} years</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted"><i class="fa-solid fa-building-columns me-2 text-primary"></i> Department</span>
                        <span class="badge-dept">
                            <i class="fa-solid fa-building"></i>
                            {{ $student->department->dept_name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="list-group-item py-3">
                        <div class="text-muted mb-2"><i class="fa-regular fa-file-lines me-2 text-primary"></i> Additional Information</div>
                        <div class="bg-light p-3 rounded text-dark small">
                            {{ $student->description ?? 'No additional notes provided.' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Directory
                    </a>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary px-4">
                        <i class="fa-solid fa-pencil me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
