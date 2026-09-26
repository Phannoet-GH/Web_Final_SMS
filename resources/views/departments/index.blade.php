@extends('layouts.app')

@section('title', 'Departments - Student Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-10">

        <!-- Top Header & Action -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <div class="d-inline-flex align-items-center gap-2 mb-1">
                    <h2 class="h4 fw-bold text-dark mb-0 tracking-tight">Academic Departments</h2>
                    <span class="badge-minimal">{{ $departments->count() }} Departments</span>
                </div>
                <p class="text-muted small mb-0">Manage faculty divisions, departmental managers, and office locations</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-solid fa-users text-muted"></i>
                    <span>Student Directory</span>
                </a>
                <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Department</span>
                </a>
            </div>
        </div>

        <!-- Department Table Card -->
        <div class="app-card mb-4">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>Department Name</th>
                            <th>Manager ID</th>
                            <th>Location / Room</th>
                            <th>Enrolled Students</th>
                            <th class="text-end" style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $dept)
                            <tr>
                                <!-- ID -->
                                <td>
                                    <span class="badge-minimal text-muted font-monospace">#{{ str_pad($dept->department_id, 2, '0', STR_PAD_LEFT) }}</span>
                                </td>

                                <!-- Department Name -->
                                <td>
                                    <div class="fw-semibold text-dark d-flex align-items-center gap-2">
                                        <div class="user-avatar-sm" style="background-color: var(--bg-muted); color: var(--text-main); border: 1px solid var(--border-color);">
                                            <i class="fa-solid fa-building-columns" style="font-size: 0.75rem;"></i>
                                        </div>
                                        <span>{{ $dept->dept_name }}</span>
                                    </div>
                                    @if($dept->description)
                                        <div class="text-muted small mt-1 ms-4 ps-1" style="font-size: 0.75rem;">
                                            {{ Str::limit($dept->description, 70) }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Manager ID -->
                                <td>
                                    <span class="badge-minimal font-monospace">
                                        {{ $dept->manager_id ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- Location -->
                                <td>
                                    <span class="text-secondary small">
                                        <i class="fa-solid fa-location-dot text-danger opacity-75 me-1"></i>
                                        {{ $dept->location_id ?? 'Not Assigned' }}
                                    </span>
                                </td>

                                <!-- Enrolled Students Count -->
                                <td>
                                    <span class="badge-dept">
                                        <i class="fa-solid fa-user-graduate me-1"></i>
                                        {{ $dept->students_count }} students
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('departments.edit', $dept) }}" class="btn-action-icon btn-action-edit" title="Edit Department">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <button
                                            type="button"
                                            class="btn-action-icon btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteDeptModal{{ $dept->department_id }}"
                                            title="Delete Department"
                                        >
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Department Modal -->
                                    <div class="modal fade" id="deleteDeptModal{{ $dept->department_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content modal-content-minimal">
                                                <div class="modal-body p-4 text-center">
                                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </div>
                                                    <h5 class="fw-bold mb-1">Delete Department?</h5>
                                                    <p class="text-muted small mb-3">
                                                        Are you sure you want to delete <strong>{{ $dept->dept_name }}</strong>?
                                                        @if($dept->students_count > 0)
                                                            <br><span class="text-danger fw-medium small mt-1 d-inline-block">Caution: This department contains {{ $dept->students_count }} enrolled student(s)!</span>
                                                        @endif
                                                    </p>
                                                    <form action="{{ route('departments.destroy', $dept) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger px-3">Confirm Delete</button>
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
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">No departments found</h6>
                                    <p class="small text-muted mb-3">Get started by creating your first academic department.</p>
                                    <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-plus me-1"></i> Add First Department
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
