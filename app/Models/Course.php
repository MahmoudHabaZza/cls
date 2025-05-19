<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'level',
        'price',
        'sessions_count',
        'thumbnail'
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->using(Enrollment::class)
            ->withPivot(['enrolled_at', 'progress'])
            ->withTimestamps();
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certifiedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'certificates')
            ->using(Certificate::class)
            ->withPivot(['certificated_at', 'certificate_file_path'])
            ->withTimestamps();
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
    public function weeks(): HasMany
    {
        return $this->hasMany(Week::class)->orderBy('order');
    }
}
