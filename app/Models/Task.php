<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'time_spent_minutes',
    ];

    protected function casts(): array
    {
        return [
            'time_spent_minutes' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwned(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }
}

