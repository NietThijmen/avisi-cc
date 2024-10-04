<?php

namespace App\Livewire\Pages\Admin;

use App\Enums\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class Teachers extends Component
{
    public string $first_name = '';
    public string $middle_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';

    public int $page = 0;
    public array $teachers = [];

    public function get_teachers()
    {
//        $teacherCollection = Teacher::limit(25)->offset($this->page * 25)->get();
        $teacherCollection = User::where('role', '=', Role::Teacher->name)->withTrashed()->limit(25)->offset($this->page * 25)->get();
        $teacherArray = [];
        foreach ($teacherCollection as $teacher) {
            $teacherArray[] = [
                'id' => $teacher->id,
                'first_name' => $teacher->first_name,
                'middle_name' => $teacher->middle_name,
                'last_name' => $teacher->last_name,
                'email' => $teacher->email,
                'active' => $teacher->trashed() ? true : false,
                'created_at' => $teacher->created_at->format('j-M Y')
            ];
        }

        $this->teachers = $teacherArray;
    }

    public function pagePlus()
    {
        $this->page++;
        $this->get_teachers();
    }

    public function pageMin()
    {
        $this->page--;
        if($this->page < 0) {
            $this->page = 0;
        }
        $this->get_teachers();
    }

    public function createTeacher()
    {
        $user = User::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => Role::Teacher
        ]);
        try {
            Teacher::create([
                'user_id' => $user->id,
            ]);
        } catch (\Exception $exception) {
            $user->delete();
            throw $exception;
        }
    }

    public function toggleActivity($id)
    {
        $teacher = User::withTrashed()->find($id);

        try {
            $teacher->trashed() ? $teacher->restore() : $teacher->delete();
        } catch (\Throwable $exception) {
            $teacher->restore();
        }
    }
    public function render()
    {
        $this->get_teachers();
        return view('livewire.pages.admin.teachers');
    }
}
