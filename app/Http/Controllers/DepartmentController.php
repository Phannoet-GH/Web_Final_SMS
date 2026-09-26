<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index(): View
    {
        $departments = Department::withCount('students')->orderBy('dept_name')->get();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create(): View
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dept_name' => ['required', 'string', 'max:255', 'unique:departments,dept_name'],
            'manager_id' => ['nullable', 'string', 'max:100'],
            'location_id' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department '.$validated['dept_name'].' created successfully!');
    }

    /**
     * Show the form for editing the department.
     */
    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department.
     */
    public function update(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'dept_name' => ['required', 'string', 'max:255', 'unique:departments,dept_name,'.$department->department_id.',department_id'],
            'manager_id' => ['nullable', 'string', 'max:100'],
            'location_id' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department '.$department->dept_name.' updated successfully!');
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $department): RedirectResponse
    {
        $name = $department->dept_name;
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department '.$name.' deleted successfully.');
    }
}
