<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'schedule_days',
        'start_time',
        'end_time',
        'student_limit',
        'teacher_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BatchSubject, $this>
     */
    public function subjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BatchSubject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, $this>
     */
    public function teachers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Lecture, $this>
     */
    public function lectures(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lecture::class)->orderBy('created_at', 'desc');
    }

    public function assignments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Assignment::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BatchNote, $this>
     */
    public function batchNotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BatchNote::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Enrollment, $this>
     */
    public function enrollments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough<User, Enrollment, $this>
     */
    public function students(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
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

    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeWithEnrollmentCount(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
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
        $timeStart = \Carbon\Carbon::parse($this->start_time)->format('g:i A');

        return implode(', ', $formatted).' • '.$timeStart;
    }

    /**
     * Get the next scheduled class Carbon instance.
     */
    public function nextClassAt(): ?\Carbon\Carbon
    {
        if (empty($this->schedule_days)) {
            return null;
        }

        $dayMap = ['SUN' => 0, 'MON' => 1, 'TUE' => 2, 'WED' => 3, 'THU' => 4, 'FRI' => 5, 'SAT' => 6];
        $startTime = \Carbon\Carbon::parse($this->start_time);
        $scheduledDays = array_filter(
            array_map(fn ($d) => $dayMap[$d] ?? null, $this->schedule_days),
            fn ($d) => $d !== null
        );

        $now = \Carbon\Carbon::now();

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
