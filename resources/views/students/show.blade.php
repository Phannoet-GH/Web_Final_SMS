@extends('layouts.app')

@section('title', 'Student Profile - ' . $student->student_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        <!-- Top Header Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-dark mb-1 tracking-tight">Student Profile</h3>
                <p class="text-muted small mb-0">Full record details for {{ $student->student_name }}</p>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left text-muted"></i>
                <span>Back to Directory</span>
            </a>
        </div>

        <div class="app-card mb-5">
            <!-- Minimalist Card Header -->
            <div class="minimal-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="header-badge mb-1">
                            <i class="fa-solid fa-id-card"></i> Student Record
                        </span>
                        <h2>{{ $student->student_name }}</h2>
                        <p>Registered Student &bull; {{ $student->department->dept_name ?? 'Unassigned Department' }}</p>
                    </div>
                    <div class="student-avatar" style="width: 52px; height: 52px; font-size: 1.25rem; background-color: var(--primary); color: white;">
                        {{ strtoupper(substr($student->student_name, 0, 2)) }}
                    </div>
                </div>
            </div>

            <!-- Body Details -->
            <div class="p-4 p-md-5">
                <!-- Info List Group (Clean Border Table / List) -->
                <div class="list-group list-group-flush rounded-3 border mb-4">
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-regular fa-hashtag me-2 text-muted"></i>Student ID</span>
                        <span class="badge-minimal font-monospace">#{{ str_pad($student->student_id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-regular fa-envelope me-2 text-muted"></i>Email Address</span>
                        <span class="fw-medium text-dark small">{{ $student->email }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-solid fa-venus-mars me-2 text-muted"></i>Gender</span>
                        <span class="badge-minimal">{{ $student->gender }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-regular fa-calendar-days me-2 text-muted"></i>Enrollment Date</span>
                        <span class="fw-medium text-dark small">{{ $student->enrollment_date ? $student->enrollment_date->format('F d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-regular fa-clock me-2 text-muted"></i>Duration Enrolled</span>
                        <span class="fw-semibold text-primary small">{{ $student->years_enrolled_decimal }} years</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                        <span class="text-muted small"><i class="fa-solid fa-building-columns me-2 text-muted"></i>Academic Department</span>
                        @if($student->department)
                            <span class="badge-dept">
                                <i class="fa-solid fa-building me-1"></i>{{ $student->department->dept_name }}
                            </span>
                        @else
                            <span class="badge-minimal text-muted">Unassigned</span>
                        @endif
                    </div>
                    <div class="list-group-item py-3 px-3">
                        <div class="text-muted small mb-2"><i class="fa-regular fa-file-lines me-2 text-muted"></i>Additional Information / Notes</div>
                        <div class="bg-light p-3 rounded border text-secondary small">
                            {{ $student->description ?? 'No additional description provided for this student record.' }}
                        </div>
                    </div>
                </div>

                <!-- Action Footer Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-2">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-3">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back to Directory</span>
                    </a>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary px-4">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
