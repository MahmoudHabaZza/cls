<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSession extends Model
{
    /** @use HasFactory<\Database\Factories\SessionFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'level',
        'price',
        'sessions_count',
        'thumbnail'
    ];
    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)->orderBy('order');
    }

    public function sessionCompletions(): HasMany
    {
        return $this->hasMany(SessionCompletion::class);
    }

    public function completedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'session_completions')
            ->using(SessionCompletion::class)
            ->withPivot('completed_at')
            ->withTimestamps();
    }
}
