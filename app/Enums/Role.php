<?php

namespace App\Enums;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

enum Role
{
    case Student;
    case Teacher;
    case Admin;

    public function newModel($attributes = []): Model
    {
        return new ($this->className())($attributes);
    }

    public function className(): string
    {
        return match ($this) {
            Role::Student => Student::class,
            Role::Teacher => Teacher::class,
        };
    }
}