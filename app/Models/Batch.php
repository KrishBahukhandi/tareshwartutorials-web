<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'schedule_days',
        'start_time',
        'end_time',
        'student_limit',
        'is_active',
        'meeting_link',
        'meeting_title',
        'meeting_scheduled_at',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'schedule_days' => 'array',
            'is_active' => 'boolean',
            'meeting_scheduled_at' => 'datetime',
            'price' => 'decimal:2',
        ];
    }

    /**
     * @return HasMany<BatchSubject, $this>
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(BatchSubject::class);
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'batch_subjects', 'batch_id', 'teacher_id')
            ->withPivot('name')
            ->distinct();
    }

    public function hasTeacher(int $userId): bool
    {
        return $this->teachers()->where('users.id', $userId)->exists();
    }

    /**
     * @return HasMany<Lecture, $this>
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class)->orderBy('created_at', 'desc');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return HasMany<BatchNote, $this>
     */
    public function batchNotes(): HasMany
    {
        return $this->hasMany(BatchNote::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return HasMany<Enrollment, $this>
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * @return HasManyThrough<User, Enrollment, $this>
     */
    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            Enrollment::class,
            'batch_id',
            'id',
            'id',
            'student_id'
        )->where('enrollments.status', 'active');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeWithEnrollmentCount(Builder $query): Builder
    {
        return $query->withCount([
            'enrollments as active_enrollments_count' => fn ($query) => $query->where('status', 'active'),
        ]);
    }

    public function enrollmentCount(): int
    {
        if (array_key_exists('active_enrollments_count', $this->attributes)) {
            return (int) $this->active_enrollments_count;
        }

        return $this->enrollments()->where('status', 'active')->count();
    }

    public function isFull(): bool
    {
        return $this->enrollmentCount() >= $this->student_limit;
    }

    public function availableSeats(): int
    {
        return max(0, $this->student_limit - $this->enrollmentCount());
    }

    public function canAcceptEnrollment(): bool
    {
        return $this->is_active && ! $this->isFull();
    }

    public function formattedSchedule(): string
    {
        $days = $this->schedule_days ?? [];
        $dayMap = [
            'MON' => 'Mon',
            'TUE' => 'Tue',
            'WED' => 'Wed',
            'THU' => 'Thu',
            'FRI' => 'Fri',
            'SAT' => 'Sat',
        ];

        $formatted = array_map(fn ($d) => $dayMap[$d] ?? $d, $days);
        $timeStart = Carbon::parse($this->start_time)->format('g:i A');

        return implode(', ', $formatted).' • '.$timeStart;
    }

    /**
     * Get the next scheduled class Carbon instance.
     */
    public function nextClassAt(): ?Carbon
    {
        if (empty($this->schedule_days)) {
            return null;
        }

        $dayMap = ['SUN' => 0, 'MON' => 1, 'TUE' => 2, 'WED' => 3, 'THU' => 4, 'FRI' => 5, 'SAT' => 6];
        $startTime = Carbon::parse($this->start_time);
        $scheduledDays = array_filter(
            array_map(fn ($d) => $dayMap[$d] ?? null, $this->schedule_days),
            fn ($d) => $d !== null
        );

        $now = Carbon::now();

        for ($i = 0; $i <= 7; $i++) {
            $candidate = $now->copy()->addDays($i)->setTime($startTime->hour, $startTime->minute, 0);
            if (in_array($candidate->dayOfWeek, $scheduledDays) && $candidate->isAfter($now)) {
                return $candidate;
            }
        }

        return null;
    }

    public function nextClassForHumans(): string
    {
        $next = $this->nextClassAt();
        if (! $next) {
            return 'No upcoming class';
        }

        return $next->format('D, g:i A');
    }
}
