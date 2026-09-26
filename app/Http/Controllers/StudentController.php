<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of students with search, filters, and stats.
     */
    public function index(Request $request): View
    {
        $query = Student::with('department');

        // Search by student name, email, or department name
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search): void {
                $q->where('student_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($dq) use ($search): void {
                        $dq->where('dept_name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by Department
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        // Filter by Gender
        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('student_id', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('student_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('student_name', 'desc');
                break;
            case 'enrollment_newest':
                $query->orderBy('enrollment_date', 'desc');
                break;
            case 'enrollment_oldest':
                $query->orderBy('enrollment_date', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('student_id', 'desc');
                break;
        }

        $students = $query->paginate(10)->withQueryString();

        // Calculate Stats for KPI Cards
        $totalStudents = Student::count();
        $totalDepartments = Department::count();

        // Average enrollment calculation
        $allStudents = Student::all();
        $avgYears = 0.0;
        if ($allStudents->isNotEmpty()) {
            $totalYears = $allStudents->sum(function (Student $student): float {
                return $student->enrollment_date
                    ? abs($student->enrollment_date->floatDiffInYears(now()))
                    : 0.0;
            });
            $avgYears = round($totalYears / $allStudents->count(), 1);
        }

        $departments = Department::orderBy('dept_name')->get();

        return view('students.index', compact(
            'students',
            'departments',
            'totalStudents',
            'totalDepartments',
            'avgYears'
        ));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create(): View
    {
        $departments = Department::orderBy('dept_name')->get();

        return view('students.create', compact('departments'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'enrollment_date' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,department_id'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student '.$validated['student_name'].' was registered successfully!');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load('department');

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'student' => $student,
                'department' => $student->department,
                'years_enrolled' => $student->years_enrolled_decimal,
            ]);
        }

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student): View
    {
        $departments = Department::orderBy('dept_name')->get();

        return view('students.edit', compact('student', 'departments'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'enrollment_date' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,department_id'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student profile for '.$student->student_name.' has been updated.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        $name = $student->student_name;
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student '.$name.' has been deleted.');
    }
}
