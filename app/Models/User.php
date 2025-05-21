<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ApiResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ApiResetPasswordNotification($token));
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->using(Enrollment::class)
            ->withPivot(['enrolled_at', 'progress']);
    }


    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function certifiedCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'certificates')
            ->using(Certificate::class)
            ->withPivot(['certificated_at', 'certificate_file_path'])
            ->withTimestamps();
    }


    public function sessionCompletions(): HasMany
    {
        return $this->hasMany(SessionCompletion::class);
    }

    public function completedCourseSessions(): BelongsToMany
    {
        return $this->belongsToMany(CourseSession::class, 'session_completions')
            ->using(SessionCompletion::class)
            ->withPivot('completed_at')
            ->withTimestamps();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
