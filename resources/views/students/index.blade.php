@extends('layouts.app')

@section('title', 'Student Directory - Browse and Manage Students')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-11">
        <div class="app-card border-0 mb-4">
            <!-- Gradient Header Banner matching Page 7 -->
            <div class="gradient-header text-center">
                <div class="d-inline-flex align-items-center justify-content-center mb-2" style="font-size: 2.2rem;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h1 class="h2 fw-bold text-white mb-1">Student Directory</h1>
                <p class="mb-4">Browse and manage all registered students</p>

                <!-- 3 Stat KPI Cards inside Header -->
                <div class="row g-3 justify-content-center mt-2">
                    <div class="col-auto">
                        <div class="kpi-stat-card">
                            <div class="stat-number">{{ $totalStudents }}</div>
                            <div class="stat-label">Total Students</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="kpi-stat-card">
                            <div class="stat-number">{{ $totalDepartments }}</div>
                            <div class="stat-label">Departments</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="kpi-stat-card">
                            <div class="stat-number">{{ $avgYears }} yrs</div>
                            <div class="stat-label">Avg. Enrollment</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search Toolbar -->
            <div class="p-4 border-bottom bg-white">
                <form action="{{ route('students.index') }}" method="GET" id="filterForm">
                    <div class="row g-3 align-items-center">
                        <!-- Search Input -->
                        <div class="col-12 col-lg-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-start-0 ps-1"
                                    placeholder="Search students by name, email, or department..."
                                    value="{{ request('search') }}"
                                >
                            </div>
                        </div>

                        <!-- Filter by Department -->
                        <div class="col-6 col-md-4 col-lg-2">
                            <select name="department_id" class="form-select" onchange="this.form.submit()">
                                <option value="">All Departments</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}" {{ request('department_id') == $dept->department_id ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort By -->
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

                        <!-- Filter by Gender -->
                        <div class="col-6 col-md-4 col-lg-2">
                            <select name="gender" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ request('gender') == 'all' || !request('gender') ? 'selected' : '' }}>All Genders</option>
                                <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Search and Reset Buttons -->
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
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th style="width: 60px;">ID</th>
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
                                <td class="fw-bold text-secondary">
                                    {{ $student->student_id }}
                                </td>

                                <!-- Student Name & Gender -->
                                <td>
                                    <div class="fw-bold text-dark">{{ $student->student_name }}</div>
                                    <div class="text-muted small">{{ $student->gender }}</div>
                                </td>

                                <!-- Contact Info -->
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-dark small">
                                        <i class="fa-regular fa-envelope text-primary"></i>
                                        <span>{{ $student->email }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 text-muted small mt-1">
                                        <i class="fa-regular fa-comment-dots"></i>
                                        <span>{{ $student->description ?? 'N/A' }}</span>
                                    </div>
                                </td>

                                <!-- Enrollment Date & Floating Years -->
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-dark small">
                                        <i class="fa-regular fa-calendar text-primary"></i>
                                        <span>{{ $student->enrollment_date ? $student->enrollment_date->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 text-muted small mt-1">
                                        <i class="fa-regular fa-clock text-info"></i>
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
                                        <span class="badge bg-secondary">Unassigned</span>
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
                                            title="View Details"
                                        >
                                            <i class="fa-regular fa-eye"></i>
                                        </button>

                                        <!-- Edit Link -->
                                        <a
                                            href="{{ route('students.edit', $student) }}"
                                            class="btn-action-icon btn-action-edit"
                                            title="Edit Student"
                                        >
                                            <i class="fa-solid fa-pencil"></i>
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

                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="viewStudentModal{{ $student->student_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                                <div class="gradient-header py-3 px-4">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="modal-title fw-bold text-white mb-0">
                                                            <i class="fa-solid fa-id-card me-2"></i> Student Profile
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="text-center mb-3">
                                                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-2" style="width: 64px; height: 64px; font-size: 1.75rem;">
                                                            <i class="fa-solid fa-user-graduate"></i>
                                                        </div>
                                                        <h4 class="fw-bold text-dark mb-0">{{ $student->student_name }}</h4>
                                                        <span class="badge bg-secondary-subtle text-secondary mt-1">ID: #{{ $student->student_id }}</span>
                                                    </div>

                                                    <div class="list-group list-group-flush rounded-3 border">
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-muted"><i class="fa-regular fa-envelope me-2 text-primary"></i> Email</span>
                                                            <span class="fw-semibold">{{ $student->email }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-muted"><i class="fa-solid fa-venus-mars me-2 text-primary"></i> Gender</span>
                                                            <span class="fw-semibold">{{ $student->gender }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-muted"><i class="fa-regular fa-calendar-days me-2 text-primary"></i> Enrollment Date</span>
                                                            <span class="fw-semibold">{{ $student->enrollment_date ? $student->enrollment_date->format('F d, Y') : 'N/A' }}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-muted"><i class="fa-regular fa-clock me-2 text-primary"></i> Years Enrolled</span>
                                                            <span class="fw-semibold text-primary">{{ $student->years_enrolled_decimal }} years</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-muted"><i class="fa-solid fa-building-columns me-2 text-primary"></i> Department</span>
                                                            <span class="fw-semibold text-primary">{{ $student->department->dept_name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="list-group-item py-2">
                                                            <div class="text-muted mb-1"><i class="fa-regular fa-file-lines me-2 text-primary"></i> Description</div>
                                                            <p class="mb-0 text-dark small bg-light p-2 rounded">{{ $student->description ?? 'No description provided.' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light border-0 py-2 px-4">
                                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-sm px-3">
                                                        <i class="fa-solid fa-pencil me-1"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteStudentModal{{ $student->student_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                                <div class="modal-body p-4 text-center">
                                                    <div class="text-danger mb-3" style="font-size: 3rem;">
                                                        <i class="fa-solid fa-circle-exclamation"></i>
                                                    </div>
                                                    <h5 class="fw-bold mb-2">Delete Student</h5>
                                                    <p class="text-muted mb-4">
                                                        Are you sure you want to delete student <strong>{{ $student->student_name }}</strong>? This action cannot be undone.
                                                    </p>
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger px-4">Delete</button>
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
                                    <i class="fa-solid fa-folder-open fs-1 text-secondary opacity-50 mb-3 d-block"></i>
                                    <h5>No students found</h5>
                                    <p class="small mb-3">Try adjusting your search query or filters.</p>
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
                <a href="{{ route('students.create') }}" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 w-100 py-2 fs-6" style="max-width: 700px;">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>+ Back to Student Form</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
