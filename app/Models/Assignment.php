<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'title',
        'description',
        'file_path',
        'due_date',
        'total_marks',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    /** Public URL for the question paper PDF, if one was uploaded. */
    public function fileUrl(): ?string
    {
        return $this->file_path
            ? \Storage::disk(config('filesystems.public_files'))->url($this->file_path)
            : null;
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
