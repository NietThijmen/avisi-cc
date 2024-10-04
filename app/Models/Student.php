<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Traits\Macroable;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'class',
        'crebo_id',
        'cohort',
        'date_of_birth',
    ];

    public function crebo(): BelongsTo
    {
        return $this->belongsTo(Crebo::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(StudentNote::class);
    }
}
