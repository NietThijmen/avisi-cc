<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'assigned_id',
        'student_id',
    ];

    public function assigned()
    {
        return $this->belongsTo(Teacher::class, 'assigned_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
