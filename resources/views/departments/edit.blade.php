@extends('layouts.app')

@section('title', 'Edit Department - ' . $department->dept_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <!-- Top Header Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-dark mb-1 tracking-tight">Edit Department</h3>
                <p class="text-muted small mb-0">Update department details for {{ $department->dept_name }}</p>
            </div>
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left text-muted"></i>
                <span>Back to Departments</span>
            </a>
        </div>

        <div class="app-card mb-5">
            <!-- Minimalist Card Header -->
            <div class="minimal-header">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="header-badge mb-0">
                        <i class="fa-solid fa-pen-to-square"></i> Department ID #{{ $department->department_id }}
                    </span>
                </div>
                <h2>Edit Department</h2>
                <p>Modify department records and faculty assignment</p>
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

                <form action="{{ route('departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Department Name -->
                    <div class="mb-3">
                        <label for="dept_name" class="form-label">Department Name</label>
                        <input
                            type="text"
                            name="dept_name"
                            id="dept_name"
                            class="form-control @error('dept_name') is-invalid @enderror"
                            placeholder="e.g. Management Information System"
                            value="{{ old('dept_name', $department->dept_name) }}"
                            required
                        >
                    </div>

                    <!-- Manager ID -->
                    <div class="mb-3">
                        <label for="manager_id" class="form-label">Manager ID <span class="text-muted fw-normal">(Optional)</span></label>
                        <input
                            type="text"
                            name="manager_id"
                            id="manager_id"
                            class="form-control @error('manager_id') is-invalid @enderror"
                            placeholder="e.g. MGR-101"
                            value="{{ old('manager_id', $department->manager_id) }}"
                        >
                    </div>

                    <!-- Location ID -->
                    <div class="mb-3">
                        <label for="location_id" class="form-label">Location / Building Room <span class="text-muted fw-normal">(Optional)</span></label>
                        <input
                            type="text"
                            name="location_id"
                            id="location_id"
                            class="form-control @error('location_id') is-invalid @enderror"
                            placeholder="e.g. Building A - Room 302"
                            value="{{ old('location_id', $department->location_id) }}"
                        >
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">Description <span class="text-muted fw-normal">(Optional)</span></label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Optional notes or details regarding this department..."
                        >{{ old('description', $department->description) }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex align-items-center gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Update Department</span>
                        </button>
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary px-3">
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
