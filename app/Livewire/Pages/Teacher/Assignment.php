<?php

namespace App\Livewire\Pages\Teacher;

use App\Models\Student;
use Livewire\Component;

class Assignment extends Component
{

    public int $page = 0;
    public array $students = [];

    public function get_students()
    {
        $studentCollection = Student::limit(25)->offset($this->page * 25)->get();
        $studentArray = [];

        foreach ($studentCollection as $student) {
            $studentArray[] = [
                'id' => $student->user->id,
                'first_name' => $student->user->first_name,
                'middle_name' => $student->user->middle_name,
                'last_name' => $student->user->last_name,
                'email' => $student->user->email,
                'class' => $student->class,
                'crebo_number' => $student->crebo_id,
                'cohort' => $student->cohort,
                'date_of_birth' => $student->date_of_birth,
                'student_number' => $student->student_number,
                'career_coach' => $student->career_coach
            ];
        }

        $this->students = $studentArray;
    }

    public function pagePlus()
    {
        $this->page++;
        $this->get_students();
    }

    public function pageMin()
    {
        $this->page--;
        if($this->page < 0) {
            $this->page = 0;
        }
        $this->get_students();
    }

    public function render()
    {
        $this->get_students();
        return view('livewire.pages.teacher.assignment');
    }
}
