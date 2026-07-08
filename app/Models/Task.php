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
        'started_at',
    ];

    protected function casts(): array
    {
        return [
            'time_spent_minutes' => 'integer',
            'started_at' => 'datetime',
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

    public function isTimerRunning(): bool
    {
        return $this->started_at !== null;
    }

    public function startTimer(): void
    {
        if ($this->started_at) {
            return;
        }

        $this->update([
            'started_at' => now(),
        ]);
    }

    public function stopTimer(): void
    {
        if (! $this->started_at) {
            return;
        }

        $minutes = $this->started_at->diffInMinutes(now());

        $this->update([
            'time_spent_minutes' => $this->time_spent_minutes + $minutes,
            'started_at' => null,
        ]);
    }

}

