@extends('layouts.app')

@section('title', 'Edit Department - ' . $department->dept_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="app-card border-0 mb-4">
            <div class="gradient-header text-center">
                <div class="d-inline-flex align-items-center justify-content-center mb-2" style="font-size: 2rem;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <h2 class="h3 fw-bold text-white mb-1">Edit Department</h2>
                <p>Modify department details for {{ $department->dept_name }}</p>
            </div>

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

                <form action="{{ route('departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Department Name -->
                    <div class="mb-3">
                        <label for="dept_name" class="form-label text-secondary fw-semibold small">Department Name</label>
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
                        <label for="manager_id" class="form-label text-secondary fw-semibold small">Manager ID</label>
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
                        <label for="location_id" class="form-label text-secondary fw-semibold small">Location / Room</label>
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
                        <label for="description" class="form-label text-secondary fw-semibold small">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Optional notes or details about this department"
                        >{{ old('description', $department->description) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Update Department
                        </button>
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary px-3">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
