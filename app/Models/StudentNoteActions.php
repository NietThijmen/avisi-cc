<?php

namespace App\Models;

use App\Enums\StudentNoteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentNoteActions extends Model
{
    protected $fillable = [
        'student_note_id',
        'user_id',
        'action',
    ];

    protected $casts = [
        'action' => StudentNoteAction::class
    ];

    public function studentNote(): BelongsTo
    {
        return $this->belongsTo(StudentNote::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
