<?php

namespace App\Enums;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

enum Role
{
    case Student;
    case Teacher;

    public function newModel(): Model
    {
        return new ($this->className());
    }

    public function className(): string
    {
        return match ($this) {
            Role::Student => Student::class,
            Role::Teacher => Teacher::class,
        };
    }
}