<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'phone',
    'profile_photo',
    'is_active',
    'department',
    'subject',
    'highest_degree',
    'institution',
    'years_of_experience',
    'class_level',
    'board',
    'stream',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Batch, $this>
     */
    public function batches(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'batch_subjects', 'teacher_id', 'batch_id')->distinct();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Enrollment, $this>
     */
    public function enrollments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough<Batch, Enrollment, $this>
     */
    public function enrolledBatches(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            Batch::class,
            Enrollment::class,
            'student_id',
            'id',
            'id',
            'batch_id'
        );
    }

    public function isEnrolledInBatch(Batch $batch): bool
    {
        return $this->enrollments()
            ->where('batch_id', $batch->id)
            ->where('status', 'active')
            ->exists();
    }

    public function getEnrolledBatches(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->enrolledBatches()
            ->where('enrollments.status', 'active')
            ->with('teacher')
            ->orderBy('enrollments.enrollment_date', 'desc')
            ->get();
    }

    public function profilePhotoUrl(): string
    {
        return $this->profile_photo
            ? asset('storage/'.$this->profile_photo)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=1e3a5f&color=fff&size=128';
    }
}
