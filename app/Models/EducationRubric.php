<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationRubric extends Model
{
    public $fillable = [
        'name',
        'crebo_id'
    ];
    public function crebo(): BelongsTo
    {
        return $this->belongsTo(Crebo::class);
    }
}
