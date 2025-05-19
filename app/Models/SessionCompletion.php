<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SessionCompletion extends Pivot
{
    /** @use HasFactory<\Database\Factories\SessionCompletionFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_session_id', // matches your schema
        'completed_at'
    ];
    protected $casts = ['completed_at' => 'datetime'];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function courseSession():BelongsTo{
        return $this->belongsTo(CourseSession::class,'course_session_id');
    }
}
