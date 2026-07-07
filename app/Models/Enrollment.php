<?php

namespace App\Models;

use Database\Factories\EnrollmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /** @use HasFactory<EnrollmentFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'batch_id',
        'enrollment_date',
        'status',
        'progress_percentage',
        'last_accessed_at',
        'notes',
    ];

    protected $attributes = [
        'status' => 'active',
        'progress_percentage' => 0,
    ];

    protected function casts(): array
    {
        return [
            'enrollment_date' => 'datetime',
            'last_accessed_at' => 'datetime',
            'progress_percentage' => 'integer',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Batch, $this>
     */
    public function batch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('status', 'active');
    }

    public function canBeDropped(): bool
    {
        return $this->status === 'active';
    }
}
