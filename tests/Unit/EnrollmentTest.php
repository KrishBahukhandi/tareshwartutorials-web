<?php

use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('batch is full when active enrollments reach limit', function () {
    $batch = Batch::factory()->create(['student_limit' => 2]);
    Enrollment::factory()->count(2)->create(['batch_id' => $batch->id]);

    expect($batch->fresh()->isFull())->toBeTrue()
        ->and($batch->fresh()->availableSeats())->toBe(0);
});

test('available seats ignores dropped enrollments', function () {
    $batch = Batch::factory()->create(['student_limit' => 3]);
    Enrollment::factory()->create(['batch_id' => $batch->id]);
    Enrollment::factory()->dropped()->create(['batch_id' => $batch->id]);

    expect($batch->fresh()->enrollmentCount())->toBe(1)
        ->and($batch->fresh()->availableSeats())->toBe(2);
});

test('can accept enrollment requires active batch with capacity', function () {
    $openBatch = Batch::factory()->create(['student_limit' => 2, 'is_active' => true]);
    $fullBatch = Batch::factory()->create(['student_limit' => 1, 'is_active' => true]);
    $inactiveBatch = Batch::factory()->inactive()->create(['student_limit' => 2]);

    Enrollment::factory()->create(['batch_id' => $fullBatch->id]);

    expect($openBatch->fresh()->canAcceptEnrollment())->toBeTrue()
        ->and($fullBatch->fresh()->canAcceptEnrollment())->toBeFalse()
        ->and($inactiveBatch->fresh()->canAcceptEnrollment())->toBeFalse();
});

test('enrollment relationships connect student and batch', function () {
    $student = User::factory()->create(['role' => 'student', 'is_active' => true]);
    $batch = Batch::factory()->create();
    $enrollment = Enrollment::factory()->create([
        'student_id' => $student->id,
        'batch_id' => $batch->id,
    ]);

    expect($enrollment->student->is($student))->toBeTrue()
        ->and($enrollment->batch->is($batch))->toBeTrue()
        ->and($student->isEnrolledInBatch($batch))->toBeTrue()
        ->and($student->getEnrolledBatches()->first()->is($batch))->toBeTrue();
});

test('active scope returns only active enrollments', function () {
    Enrollment::factory()->create(['status' => 'active']);
    Enrollment::factory()->dropped()->create();

    expect(Enrollment::active()->count())->toBe(1);
});
