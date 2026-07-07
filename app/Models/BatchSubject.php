<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchSubject extends Model
{
    protected $fillable = [
        'batch_id',
        'name',
        'teacher_id',
    ];

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
}
