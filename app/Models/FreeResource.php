<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'class_level',
        'subject',
        'chapter',
        'board',
        'year',
        'file_path',
        'thumbnail',
        'download_count',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'download_count' => 'integer',
            'year' => 'integer',
        ];
    }

    /**
     * NCERT subjects grouped by class — single source of truth.
     *
     * @return array<string, array<string, string[]>>
     */
    public static function ncertSubjectsByClass(): array
    {
        return [
            '10' => [
                'Science & Maths'   => ['Mathematics', 'Science'],
                'Social Science'    => ['History', 'Geography', 'Political Science', 'Economics'],
                'Languages'         => ['English', 'Hindi', 'Sanskrit'],
            ],
            '11' => [
                'Science'           => ['Physics', 'Chemistry', 'Mathematics', 'Biology'],
                'Commerce'          => ['Business Studies', 'Accountancy', 'Economics'],
                'Humanities'        => ['History', 'Geography', 'Political Science'],
                'Languages'         => ['English', 'Hindi'],
            ],
            '12' => [
                'Science'           => ['Physics', 'Chemistry', 'Mathematics', 'Biology'],
                'Commerce'          => ['Business Studies', 'Accountancy', 'Economics'],
                'Humanities'        => ['History', 'Geography', 'Political Science'],
                'Languages'         => ['English', 'Hindi'],
            ],
        ];
    }

    /**
     * Flat list of all subjects for a given class.
     *
     * @return string[]
     */
    public static function subjectsForClass(string $class): array
    {
        $groups = static::ncertSubjectsByClass()[$class] ?? [];

        return collect($groups)->flatten()->unique()->values()->all();
    }

    /** Scope: published only. */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /** Human-readable class label. */
    public function classLabel(): string
    {
        return 'Class '.$this->class_level;
    }

    /** Storage URL for the PDF. */
    public function fileUrl(): string
    {
        return asset('storage/'.$this->file_path);
    }
}
