<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'description',
        'icon',
        'color',
    ];

    public function updatedAtForHumans(): string
    {
        return $this->updated_at->diffForHumans();
    }
}
