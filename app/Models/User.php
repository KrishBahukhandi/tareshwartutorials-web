<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
    'must_change_password',
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
            'must_change_password' => 'boolean',
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
     * @return BelongsToMany<Batch, $this>
     */
    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'batch_subjects', 'teacher_id', 'batch_id')->distinct();
    }

    /**
     * @return HasMany<Enrollment, $this>
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    /**
     * @return HasManyThrough<Batch, Enrollment, $this>
     */
    public function enrolledBatches(): HasManyThrough
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

    public function getEnrolledBatches(): Collection
    {
        return $this->enrolledBatches()
            ->where('enrollments.status', 'active')
            ->with('teachers')
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
