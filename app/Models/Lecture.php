<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'batch_id',
        'title',
        'video_url',
        'duration',
        'description',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'views_count' => 'integer',
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
     * Extract a YouTube video ID from the URL.
     */
    public function youtubeId(): ?string
    {
        preg_match(
            '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $this->video_url,
            $matches
        );

        return $matches[1] ?? null;
    }

    /**
     * Return a thumbnail URL — YouTube native thumbnail if applicable, generic fallback otherwise.
     */
    public function thumbnailUrl(): string
    {
        $youtubeId = $this->youtubeId();
        if ($youtubeId) {
            return "https://img.youtube.com/vi/{$youtubeId}/mqdefault.jpg";
        }

        return 'https://placehold.co/320x180/1e3a5f/ffffff?text=Lecture';
    }

    /**
     * Return the embeddable URL for iframes.
     */
    public function embedUrl(): ?string
    {
        $youtubeId = $this->youtubeId();
        if ($youtubeId) {
            return "https://www.youtube.com/embed/{$youtubeId}";
        }

        return null;
    }
}
