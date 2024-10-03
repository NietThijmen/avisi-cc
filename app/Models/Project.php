<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'po_id',
        'student_id',
    ];

    public function po()
    {
        return $this->belongsTo(Teacher::class, 'po_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
