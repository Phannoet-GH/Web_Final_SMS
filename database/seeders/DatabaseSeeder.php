<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed User for Login & Register Form (Page 4 & 5)
        User::firstOrCreate(
            ['email' => 'adminwoman@gmail.com'],
            [
                'name' => 'Admin Woman',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Departments (Page 3, 7, 8)
        $mis = Department::updateOrCreate(
            ['department_id' => 1],
            [
                'dept_name' => 'Management Information System',
                'manager_id' => 'MGR-101',
                'location_id' => 'Building A - Room 302',
                'description' => 'Department of Management Information Systems',
            ]
        );

        $design = Department::updateOrCreate(
            ['department_id' => 2],
            [
                'dept_name' => 'Design',
                'manager_id' => 'MGR-102',
                'location_id' => 'Building B - Room 105',
                'description' => 'Department of Digital & Graphic Design',
            ]
        );

        $cs = Department::updateOrCreate(
            ['department_id' => 3],
            [
                'dept_name' => 'Computer Science',
                'manager_id' => 'MGR-103',
                'location_id' => 'Building C - Lab 4',
                'description' => 'Department of Computer Science & Software Engineering',
            ]
        );

        // 3. Seed Students (Page 7 & 8)
        Student::updateOrCreate(
            ['student_id' => 1],
            [
                'student_name' => 'Kong Sopheak',
                'email' => 'kongsopheak@gmail.com',
                'gender' => 'Male',
                'enrollment_date' => '2022-01-01',
                'description' => null,
                'department_id' => 1,
            ]
        );

        Student::updateOrCreate(
            ['student_id' => 2],
            [
                'student_name' => 'Ly Chhailin',
                'email' => 'lin@gmail.com',
                'gender' => 'Female',
                'enrollment_date' => '2022-01-01',
                'description' => null,
                'department_id' => 2,
            ]
        );

        Student::updateOrCreate(
            ['student_id' => 3],
            [
                'student_name' => 'Pov Nita',
                'email' => 'povnita@gmail.com',
                'gender' => 'Female',
                'enrollment_date' => '2023-04-11',
                'description' => 'OK',
                'department_id' => 1,
            ]
        );

        Student::updateOrCreate(
            ['student_id' => 4],
            [
                'student_name' => 'Leng Makara',
                'email' => 'lengmakara@gmail.com',
                'gender' => 'Male',
                'enrollment_date' => '2024-11-01',
                'description' => null,
                'department_id' => 2,
            ]
        );
    }
}
