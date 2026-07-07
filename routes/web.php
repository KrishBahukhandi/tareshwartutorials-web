<?php

use App\Http\Controllers\Admin\BatchController as AdminBatchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResourceController as AdminResourceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\ResourceController as PublicResourceController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Teacher\BatchController as TeacherBatchController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\LectureController;
use App\Http\Controllers\Teacher\MeetingController;
use App\Http\Controllers\Teacher\NoteController;
use App\Http\Controllers\Teacher\ResourceController as TeacherResourceController;
use App\Http\Controllers\Teacher\ScheduleController as TeacherScheduleController;
use App\Http\Controllers\Teacher\SettingsController as TeacherSettingsController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// ─── Public ───────────────────────────────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/batches', [PublicController::class, 'batches'])->name('batches.index');
Route::get('/batches/{batch}', [PublicController::class, 'showBatch'])->name('batches.show');
Route::get('/support', [PublicController::class, 'support'])->name('support');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');
// Free Notes / Resources (no auth required)
Route::get('/notes', [PublicResourceController::class, 'index'])->name('notes.index');
Route::get('/pyqs', [PublicResourceController::class, 'pyqs'])->name('pyqs.index');
Route::get('/notes/{freeResource}', [PublicResourceController::class, 'show'])->name('notes.show');
Route::get('/notes/{freeResource}/download', [PublicResourceController::class, 'download'])->name('notes.download');


// Auth — Login
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Auth — Student Registration
Route::get('/register', [RegisterController::class, 'showStep1'])->name('register');
Route::post('/register', [RegisterController::class, 'storeStep1'])->name('register.step1');
Route::get('/register/academic', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/academic', [RegisterController::class, 'storeStep2'])->name('register.step2.store');


// ─── Admin ────────────────────────────────────────────────────────────────────
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Teachers
        Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::patch('teachers/{teacher}/toggle', [TeacherController::class, 'toggle'])->name('teachers.toggle');

        // Batches
        Route::get('batches', [AdminBatchController::class, 'index'])->name('batches.index');
        Route::get('/batches/{batch}', [AdminBatchController::class, 'show'])->name('batches.show');
        Route::post('/batches/{batch}/subjects/{subject}/assign', [AdminBatchController::class, 'assignTeacher'])->name('batches.assignTeacher');
        Route::post('batches', [AdminBatchController::class, 'store'])->name('batches.store');
        Route::put('batches/{batch}', [AdminBatchController::class, 'update'])->name('batches.update');
        Route::delete('batches/{batch}', [AdminBatchController::class, 'destroy'])->name('batches.destroy');

        // Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        // Free Resources (Notes & PYQs)
        Route::get('resources', [AdminResourceController::class, 'index'])->name('resources.index');
        Route::get('resources/create', [AdminResourceController::class, 'create'])->name('resources.create');
        Route::post('resources', [AdminResourceController::class, 'store'])->name('resources.store');
        Route::delete('resources/{resource}', [AdminResourceController::class, 'destroy'])->name('resources.destroy');
        Route::patch('resources/{resource}/toggle', [AdminResourceController::class, 'toggle'])->name('resources.toggle');
    });

// ─── Student ─────────────────────────────────────────────────────────────────
Route::prefix('student')
    ->name('student.')
    ->middleware(['auth', 'role:student'])
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/batches/{batch}/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
        Route::post('/batches/{batch}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
        Route::delete('/batches/{batch}/enroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    });

// ─── Teacher ──────────────────────────────────────────────────────────────────
Route::prefix('teacher')
    ->name('teacher.')
    ->middleware(['auth', 'role:teacher'])
    ->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'index'])->name('dashboard');
        
        // Settings, Schedule, Resources
        Route::get('resources', [TeacherResourceController::class, 'index'])->name('resources');
        Route::post('resources', [TeacherResourceController::class, 'store'])->name('resources.store');
        Route::get('schedule', [TeacherScheduleController::class, 'index'])->name('schedule');
        Route::get('settings', [TeacherSettingsController::class, 'index'])->name('settings');
        Route::put('settings', [TeacherSettingsController::class, 'update'])->name('settings.update');

        // Batches
        Route::get('batches', [TeacherBatchController::class, 'index'])->name('batches.index');
        Route::get('batches/{batch}', [TeacherBatchController::class, 'show'])->name('batches.show');

        // Meeting link
        Route::put('batches/{batch}/meeting', [MeetingController::class, 'update'])->name('batches.meeting.update');

        // Lectures
        Route::post('batches/{batch}/lectures', [LectureController::class, 'store'])->name('batches.lectures.store');
        Route::delete('batches/{batch}/lectures/{lecture}', [LectureController::class, 'destroy'])->name('batches.lectures.destroy');

        // Notes
        Route::post('batches/{batch}/notes', [NoteController::class, 'store'])->name('batches.notes.store');
        Route::get('batches/{batch}/notes/{note}/download', [NoteController::class, 'download'])->name('batches.notes.download');
        Route::delete('batches/{batch}/notes/{note}', [NoteController::class, 'destroy'])->name('batches.notes.destroy');
    });
