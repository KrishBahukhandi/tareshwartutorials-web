<?php

use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function student(array $attributes = []): User
{
    return User::factory()->create([
        'role' => 'student',
        'is_active' => true,
        ...$attributes,
    ]);
}

function teacher(array $attributes = []): User
{
    return User::factory()->create([
        'role' => 'teacher',
        'is_active' => true,
        ...$attributes,
    ]);
}

test('student can enroll in active batch', function () {
    $student = student();
    $batch = Batch::factory()->create(['student_limit' => 2]);

    $response = $this->actingAs($student)
        ->post(route('student.enrollments.store', $batch));

    $response->assertRedirect(route('student.dashboard'));
    $this->assertDatabaseHas('enrollments', [
        'student_id' => $student->id,
        'batch_id' => $batch->id,
        'status' => 'active',
        'progress_percentage' => 0,
    ]);
});

test('student cannot enroll if batch is full', function () {
    $student = student();
    $batch = Batch::factory()->create(['student_limit' => 1]);
    Enrollment::factory()->create(['batch_id' => $batch->id]);

    $response = $this->actingAs($student)
        ->from(route('batches.show', $batch))
        ->post(route('student.enrollments.store', $batch));

    $response->assertRedirect(route('batches.show', $batch));
    $response->assertSessionHasErrors('batch');
    expect($batch->fresh()->enrollmentCount())->toBe(1);
});

test('student cannot enroll twice in same batch', function () {
    $student = student();
    $batch = Batch::factory()->create();
    Enrollment::factory()->create([
        'student_id' => $student->id,
        'batch_id' => $batch->id,
    ]);

    $response = $this->actingAs($student)
        ->from(route('batches.show', $batch))
        ->post(route('student.enrollments.store', $batch));

    $response->assertRedirect(route('batches.show', $batch));
    $response->assertSessionHasErrors('batch');
    expect(Enrollment::where('student_id', $student->id)->where('batch_id', $batch->id)->count())->toBe(1);
});

test('student cannot enroll in inactive batch', function () {
    $student = student();
    $batch = Batch::factory()->inactive()->create();

    $response = $this->actingAs($student)
        ->from(route('batches.show', $batch))
        ->post(route('student.enrollments.store', $batch));

    $response->assertRedirect(route('batches.show', $batch));
    $response->assertSessionHasErrors('batch');
    expect(Enrollment::count())->toBe(0);
});

test('student can drop active batch enrollment', function () {
    $student = student();
    $batch = Batch::factory()->create();
    $enrollment = Enrollment::factory()->create([
        'student_id' => $student->id,
        'batch_id' => $batch->id,
    ]);

    $response = $this->actingAs($student)
        ->delete(route('student.enrollments.destroy', $batch));

    $response->assertRedirect(route('student.dashboard'));
    expect($enrollment->fresh()->status)->toBe('dropped');
});

test('dropped enrollment is not counted as active', function () {
    $batch = Batch::factory()->create(['student_limit' => 1]);
    Enrollment::factory()->dropped()->create(['batch_id' => $batch->id]);

    expect($batch->fresh()->enrollmentCount())->toBe(0)
        ->and($batch->fresh()->isFull())->toBeFalse();
});

test('unauthenticated users cannot enroll', function () {
    $batch = Batch::factory()->create();

    $response = $this->post(route('student.enrollments.store', $batch));

    $response->assertRedirect(route('login'));
});

test('only students can access enrollment routes', function () {
    $teacher = teacher();
    $batch = Batch::factory()->create();

    $response = $this->actingAs($teacher)
        ->post(route('student.enrollments.store', $batch));

    $response->assertForbidden();
});
