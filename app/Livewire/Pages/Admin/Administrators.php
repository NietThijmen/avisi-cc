<?php

namespace App\Livewire\Pages\Admin;

use App\Enums\Role;
use App\Models\Student;
use App\Models\administrator;
use App\Models\User;
use Livewire\Component;

class administrators extends Component
{
    public string $first_name = '';
    public string $middle_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';

    public int $page = 0;
    public array $administrators = [];

    public function get_administrators()
    {
        $administratorCollection = User::where('role', '=', Role::Admin->name)->limit(25)->offset($this->page * 25)->get();
        $administratorArray = [];

        foreach ($administratorCollection as $administrator) {
            $administratorArray[] = [
                'first_name' => $administrator->first_name,
                'middle_name' => $administrator->middle_name,
                'last_name' => $administrator->last_name,
                'email' => $administrator->email,
                'created_at' => $administrator->created_at->format('j-M Y')
            ];
        }

        $this->administrators = $administratorArray;
    }

    public function pagePlus()
    {
        $this->page++;
        $this->get_administrators();
    }

    public function pageMin()
    {
        $this->page--;
        if($this->page < 0) {
            $this->page = 0;
        }
        $this->get_administrators();
    }

    public function createAdministrator()
    {
        $user = User::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => Role::Admin
        ]);
        try {
            administrator::create([
                'user_id' => $user->id,
            ]);
        } catch (\Exception $exception) {
            $user->delete();
            throw $exception;
        }
    }
    public function render()
    {
        $this->get_administrators();
        return view('livewire.pages.admin.administrators');
    }
}
