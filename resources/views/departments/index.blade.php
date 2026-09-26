@extends('layouts.app')

@section('title', 'Departments Management')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Departments</h3>
                <p class="text-muted small mb-0">Manage academic departments and faculty divisions</p>
            </div>
            <a href="{{ route('departments.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Department</span>
            </a>
        </div>

        <div class="app-card border-0 mb-4">
            <div class="table-responsive">
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>Department Name</th>
                            <th>Manager ID</th>
                            <th>Location</th>
                            <th>Enrolled Students</th>
                            <th class="text-end" style="width: 130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $dept)
                            <tr>
                                <td class="fw-bold text-secondary">#{{ $dept->department_id }}</td>
                                <td>
                                    <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-building-columns text-primary"></i>
                                        <span>{{ $dept->dept_name }}</span>
                                    </div>
                                    @if($dept->description)
                                        <div class="text-muted small mt-1">{{ Str::limit($dept->description, 60) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border">
                                        {{ $dept->manager_id ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark small">
                                        <i class="fa-solid fa-location-dot text-danger me-1"></i>
                                        {{ $dept->location_id ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1">
                                        {{ $dept->students_count }} students
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('departments.edit', $dept) }}" class="btn-action-icon btn-action-edit" title="Edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>

                                        <button
                                            type="button"
                                            class="btn-action-icon btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteDeptModal{{ $dept->department_id }}"
                                            title="Delete"
                                        >
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteDeptModal{{ $dept->department_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                                <div class="modal-body p-4 text-center">
                                                    <div class="text-danger mb-3" style="font-size: 3rem;">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </div>
                                                    <h5 class="fw-bold mb-2">Delete Department</h5>
                                                    <p class="text-muted mb-4">
                                                        Are you sure you want to delete <strong>{{ $dept->dept_name }}</strong>?
                                                        @if($dept->students_count > 0)
                                                            <br><span class="text-danger small">Warning: This will also delete {{ $dept->students_count }} student(s) enrolled in this department!</span>
                                                        @endif
                                                    </p>
                                                    <form action="{{ route('departments.destroy', $dept) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger px-4">Confirm Delete</button>
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
                                    <i class="fa-solid fa-building-columns fs-1 text-secondary opacity-50 mb-3 d-block"></i>
                                    <h5>No departments found</h5>
                                    <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm mt-2">
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
