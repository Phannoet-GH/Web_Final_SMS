<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $response = $this->get('/students');
        $response->assertRedirect(route('login'));
    }

    public function test_student_directory_renders_with_seeded_data(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/students');

        $response->assertStatus(200);
        $response->assertSee('Student Directory');
        $response->assertSee('Browse and manage all registered students');
        $response->assertSee('Kong Sopheak');
        $response->assertSee('Ly Chhailin');
        $response->assertSee('Pov Nita');
        $response->assertSee('Leng Makara');
        $response->assertSee('Management Information System');
        $response->assertSee('Design');
    }

    public function test_student_directory_search_filter(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/students?search=Kong');

        $response->assertStatus(200);
        $response->assertSee('Kong Sopheak');
        $response->assertDontSee('Pov Nita');
    }

    public function test_student_directory_gender_filter(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/students?gender=Female');

        $response->assertStatus(200);
        $response->assertSee('Ly Chhailin');
        $response->assertSee('Pov Nita');
        $response->assertDontSee('Kong Sopheak');
    }

    public function test_student_create_form_renders_with_departments(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/students/create');

        $response->assertStatus(200);
        $response->assertSee('Student Registration');
        $response->assertSee('Complete the form below to register as a new student');
        $response->assertSee('Management Information System');
        $response->assertSee('Design');
    }

    public function test_student_can_be_created_via_form(): void
    {
        $user = User::first() ?? User::factory()->create();
        $dept = Department::first();

        $response = $this->actingAs($user)->post('/students', [
            'student_name' => 'Sok Dara',
            'email' => 'sokdara@example.com',
            'gender' => 'Male',
            'enrollment_date' => '2023-09-01',
            'department_id' => $dept->department_id,
            'description' => 'Test student registration',
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'student_name' => 'Sok Dara',
            'email' => 'sokdara@example.com',
        ]);
    }

    public function test_student_can_be_updated(): void
    {
        $user = User::first() ?? User::factory()->create();
        $student = Student::first();

        $response = $this->actingAs($user)->put('/students/'.$student->student_id, [
            'student_name' => 'Kong Sopheak Updated',
            'email' => 'kongsopheak_new@gmail.com',
            'gender' => 'Male',
            'enrollment_date' => '2022-01-01',
            'department_id' => $student->department_id,
            'description' => 'Updated notes',
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'student_id' => $student->student_id,
            'student_name' => 'Kong Sopheak Updated',
        ]);
    }

    public function test_student_can_be_deleted(): void
    {
        $user = User::first() ?? User::factory()->create();
        $student = Student::create([
            'student_name' => 'Temporary Student',
            'email' => 'temp@example.com',
            'gender' => 'Male',
            'enrollment_date' => '2024-01-01',
            'department_id' => Department::first()->department_id,
        ]);

        $response = $this->actingAs($user)->delete('/students/'.$student->student_id);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', [
            'student_id' => $student->student_id,
        ]);
    }

    public function test_department_crud_operations(): void
    {
        $user = User::first() ?? User::factory()->create();

        // 1. Index
        $response = $this->actingAs($user)->get('/departments');
        $response->assertStatus(200);
        $response->assertSee('Departments');

        // 2. Create
        $response = $this->actingAs($user)->post('/departments', [
            'dept_name' => 'Biotechnology',
            'manager_id' => 'MGR-BIO',
            'location_id' => 'Lab B',
            'description' => 'Biotech department',
        ]);
        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseHas('departments', ['dept_name' => 'Biotechnology']);
    }
}
