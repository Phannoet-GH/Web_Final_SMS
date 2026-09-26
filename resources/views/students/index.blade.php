@extends('layouts.app')

@section('title', 'Student Directory - Student Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-11">

        <!-- Top Header & Metric Highlights (Minimalist SaaS Style) -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <div class="d-inline-flex align-items-center gap-2 mb-1">
                    <h2 class="h4 fw-bold text-dark mb-0 tracking-tight">Student Directory</h2>
                    <span class="badge-minimal">Live Records</span>
                </div>
                <p class="text-muted small mb-0">Browse and manage all registered students</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-solid fa-building-columns text-muted"></i>
                    <span>Departments</span>
                </a>
                <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Register Student</span>
                </a>
            </div>
        </div>

        <!-- 3 Minimalist KPI Metric Cards (Page 7 Requirements) -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-4">
                <div class="kpi-stat-card-minimal">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="stat-label">Total Students</span>
                        <div class="user-avatar-sm" style="background-color: var(--bg-muted); color: var(--text-main); border: 1px solid var(--border-color);">
                            <i class="fa-solid fa-user-graduate" style="font-size: 0.75rem;"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $totalStudents }}</div>
                    <div class="text-muted small mt-1" style="font-size: 0.75rem;">Active enrolled records</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="kpi-stat-card-minimal">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="stat-label">Departments</span>
                        <div class="user-avatar-sm" style="background-color: var(--bg-muted); color: var(--text-main); border: 1px solid var(--border-color);">
                            <i class="fa-solid fa-building-columns" style="font-size: 0.75rem;"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $totalDepartments }}</div>
                    <div class="text-muted small mt-1" style="font-size: 0.75rem;">Academic divisions</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="kpi-stat-card-minimal">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="stat-label">Avg. Enrollment</span>
                        <div class="user-avatar-sm" style="background-color: var(--bg-muted); color: var(--text-main); border: 1px solid var(--border-color);">
                            <i class="fa-solid fa-clock-rotate-left" style="font-size: 0.75rem;"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $avgYears }} <span class="fs-6 text-muted fw-normal">yrs</span></div>
                    <div class="text-muted small mt-1" style="font-size: 0.75rem;">Mean duration enrolled</div>
                </div>
            </div>
        </div>

        <!-- Main Card Container -->
        <div class="app-card mb-4">
            <!-- Search & Filters Toolbar -->
            <div class="p-3 border-bottom bg-white">
                <form action="{{ route('students.index') }}" method="GET" id="filterForm">
                    <div class="row g-2 align-items-center">
                        <!-- Search Query Input -->
                        <div class="col-12 col-lg-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-start-0 ps-1"
                                    placeholder="Search by student name, email, or department..."
                                    value="{{ request('search') }}"
                                >
                            </div>
                        </div>

                        <!-- Department Filter -->
                        <div class="col-6 col-md-4 col-lg-2">
                            <select name="department_id" class="form-select text-truncate" onchange="this.form.submit()">
                                <option value="">All Departments</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}" {{ request('department_id') == $dept->department_id ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort Order -->
                        <div class="col-6 col-md-4 col-lg-2">
                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                                <option value="enrollment_newest" {{ request('sort') == 'enrollment_newest' ? 'selected' : '' }}>Enrollment: New to Old</option>
                                <option value="enrollment_oldest" {{ request('sort') == 'enrollment_oldest' ? 'selected' : '' }}>Enrollment: Old to New</option>
                            </select>
                        </div>

                        <!-- Gender Filter -->
                        <div class="col-6 col-md-4 col-lg-2">
                            <select name="gender" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ request('gender') == 'all' || !request('gender') ? 'selected' : '' }}>All Genders</option>
                                <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Submit & Reset Action Buttons -->
                        <div class="col-6 col-lg-1 d-flex gap-1">
                            <button type="submit" class="btn btn-primary w-100 px-2" title="Search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            @if(request()->hasAny(['search', 'department_id', 'sort', 'gender']))
                                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-2" title="Reset Filters">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Student Data Table -->
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>Student</th>
                            <th>Contact</th>
                            <th>Enrollment</th>
                            <th>Department</th>
                            <th class="text-end" style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <!-- ID -->
                                <td>
                                    <span class="badge-minimal text-muted font-monospace">#{{ str_pad($student->student_id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>

                                <!-- Student Name & Avatar -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($student->student_name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $student->student_name }}</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">
                                                <i class="fa-solid fa-venus-mars text-muted me-1"></i>{{ $student->gender }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact Info -->
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-dark small">
                                        <i class="fa-regular fa-envelope text-muted"></i>
                                        <span>{{ $student->email }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 text-muted small mt-1" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-note-sticky text-muted"></i>
                                        <span>{{ $student->description ?? 'N/A' }}</span>
                                    </div>
                                </td>

                                <!-- Enrollment Date & Years -->
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-dark small">
                                        <i class="fa-regular fa-calendar text-muted"></i>
                                        <span>{{ $student->enrollment_date ? $student->enrollment_date->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 text-muted small mt-1" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-clock text-muted"></i>
                                        <span>{{ $student->years_enrolled_decimal }} years</span>
                                    </div>
                                </td>

                                <!-- Department Badge -->
                                <td>
                                    @if($student->department)
                                        <span class="badge-dept">
                                            <i class="fa-solid fa-building-columns"></i>
                                            {{ $student->department->dept_name }}
                                        </span>
                                    @else
                                        <span class="badge-minimal text-muted">Unassigned</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <!-- View Modal Trigger -->
                                        <button
                                            type="button"
                                            class="btn-action-icon btn-action-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewStudentModal{{ $student->student_id }}"
                                            title="View Profile"
                                        >
                                            <i class="fa-regular fa-eye"></i>
                                        </button>

                                        <!-- Edit Link -->
                                        <a
                                            href="{{ route('students.edit', $student) }}"
                                            class="btn-action-icon btn-action-edit"
                                            title="Edit Student"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Delete Trigger -->
                                        <button
                                            type="button"
                                            class="btn-action-icon btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteStudentModal{{ $student->student_id }}"
                                            title="Delete Student"
                                        >
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>

                                    <!-- View Student Modal (Shadcn Minimal Dialog) -->
                                    <div class="modal fade" id="viewStudentModal{{ $student->student_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content modal-content-minimal">
                                                <div class="modal-header-minimal">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="user-avatar-sm">
                                                            <i class="fa-solid fa-user-graduate"></i>
                                                        </div>
                                                        <h5 class="modal-title">Student Profile</h5>
                                                    </div>
                                                    <button type="button" class="btn-close shadow-none btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border mb-3">
                                                        <div class="student-avatar" style="width: 46px; height: 46px; font-size: 1.1rem; background-color: var(--primary); color: white;">
                                                            {{ strtoupper(substr($student->student_name, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <h5 class="fw-bold text-dark mb-0">{{ $student->student_name }}</h5>
                                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                                <span class="badge-minimal">ID: #{{ $student->student_id }}</span>
                                                                <span class="badge-dept">{{ $student->department->dept_name ?? 'No Department' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="list-group list-group-flush rounded-3 border">
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                                            <span class="text-muted small"><i class="fa-regular fa-envelope me-2"></i>Email</span>
                                                            <span class="fw-medium text-dark small">{{ $student->email }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                                            <span class="text-muted small"><i class="fa-solid fa-venus-mars me-2"></i>Gender</span>
                                                            <span class="fw-medium text-dark small">{{ $student->gender }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                                            <span class="text-muted small"><i class="fa-regular fa-calendar me-2"></i>Enrollment Date</span>
                                                            <span class="fw-medium text-dark small">{{ $student->enrollment_date ? $student->enrollment_date->format('F d, Y') : 'N/A' }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                                            <span class="text-muted small"><i class="fa-regular fa-clock me-2"></i>Duration Enrolled</span>
                                                            <span class="fw-semibold text-primary small">{{ $student->years_enrolled_decimal }} years</span>
                                                        </div>
                                                        <div class="list-group-item py-2 px-3">
                                                            <div class="text-muted small mb-1"><i class="fa-regular fa-file-lines me-2"></i>Notes / Description</div>
                                                            <p class="mb-0 text-secondary small bg-light p-2 rounded border">{{ $student->description ?? 'No additional notes provided.' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer-minimal">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Profile
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal (Shadcn Minimal Dialog) -->
                                    <div class="modal fade" id="deleteStudentModal{{ $student->student_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content modal-content-minimal">
                                                <div class="modal-body p-4 text-center">
                                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </div>
                                                    <h5 class="fw-bold mb-1">Delete Student Record?</h5>
                                                    <p class="text-muted small mb-4">
                                                        Are you sure you want to permanently delete <strong>{{ $student->student_name }}</strong>? This action cannot be reversed.
                                                    </p>
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger px-3">Delete Student</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="user-avatar-sm mx-auto mb-2" style="width: 42px; height: 42px; font-size: 1.1rem; background-color: var(--bg-muted); color: var(--text-muted); border: 1px solid var(--border-color);">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">No students found</h6>
                                    <p class="small text-muted mb-3">Try adjusting your search criteria or filters.</p>
                                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-user-plus me-1"></i> Add New Student
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Pagination matching Page 7 -->
            <div class="p-3 border-top bg-white d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div class="text-muted small">
                    Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} entries
                </div>
                <div>
                    {{ $students->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Bottom Action: + Back to Student Form matching Page 7 -->
            <div class="p-3 border-top bg-light text-center">
                <a href="{{ route('students.create') }}" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 w-100 py-2" style="max-width: 600px;">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>+ Back to Student Form</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
