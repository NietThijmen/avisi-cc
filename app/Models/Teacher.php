<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(StudentNote::class);
    }
}
