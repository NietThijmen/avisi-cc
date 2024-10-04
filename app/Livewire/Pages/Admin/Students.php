<?php

namespace App\Livewire\Pages\Admin;

use App\Enums\Role;
use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class Students extends Component
{
    public string $first_name = '';
    public string $middle_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $class = '';
    public string $crebo_number = '';
    public string $cohort = '';
    public string $date_of_birth = '';
    public string $student_number = '';
    public string $career_coach = '';

    public int $page = 0;
    public array $students = [];

    public function get_students()
    {
        $studentCollection = Student::limit(25)->offset($this->page * 25)->get();
        $studentArray = [];

        foreach ($studentCollection as $student) {
            $studentArray[] = [
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

    public function createStudent()
    {
        $user = User::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => Role::Student
        ]);
        try {
            Student::create([
                'user_id' => $user->id,
                'class' => $this->class,
                'crebo_id' => $this->crebo_number,
                'cohort' => $this->cohort,
                'date_of_birth' => $this->date_of_birth,
                'student_number' => $this->student_number,
                'career_coach' => $this->career_coach
            ]);
        } catch (\Exception $exception) {
            $user->delete();
            throw $exception;
        }
    }
    public function render()
    {
        $this->get_students();
        return view('livewire.pages.admin.students');
    }
}
