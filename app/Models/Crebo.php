<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stringable;

class Crebo extends Model implements Stringable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'crebo_number'
    ];

    public function educationRubrics(): HasMany
    {
        return $this->hasMany(EducationRubric::class);
    }

    public function __toString(): string
    {
        return sprintf("%05d", $this->crebo_number);
    }
}
