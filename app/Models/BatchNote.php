<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchNote extends Model
{
    protected $fillable = [
        'batch_id',
        'teacher_id',
        'original_filename',
        'file_path',
        'file_type',
        'file_size_kb',
    ];

    protected function casts(): array
    {
        return [
            'file_size_kb' => 'integer',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Batch, $this>
     */
    public function batch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function formattedSize(): string
    {
        return $this->file_size_kb >= 1024
            ? round($this->file_size_kb / 1024, 1).' MB'
            : $this->file_size_kb.' KB';
    }

    /**
     * Return the correct Tailwind color class for the file type icon.
     */
    public function fileColorClass(): string
    {
        return match (strtolower($this->file_type)) {
            'pdf' => 'text-red-500',
            'docx', 'doc' => 'text-blue-500',
            'pptx', 'ppt' => 'text-orange-500',
            default => 'text-gray-400',
        };
    }

    public function fileBgClass(): string
    {
        return match (strtolower($this->file_type)) {
            'pdf' => 'bg-red-50',
            'docx', 'doc' => 'bg-blue-50',
            'pptx', 'ppt' => 'bg-orange-50',
            default => 'bg-gray-50',
        };
    }
}
