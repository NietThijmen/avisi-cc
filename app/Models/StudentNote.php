<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Traits\Macroable;

class StudentNote extends Model
{
    protected $fillable = [
        'title',
        'student_id',
        'teacher_id',
        'content',
        'read',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(StudentNoteActions::class);
    }
}
