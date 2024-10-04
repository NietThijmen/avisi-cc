<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Crebo;
use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;
use Validator;

class Crebos extends Component
{
    public array $state = [];
    public ?array $currentCrebo;
    public $crebos = [];

    private function get_crebos(): void
    {
        $creboArray = [];
        $crebos = Crebo::all()->reverse();

        foreach ($crebos as $crebo) {
            $creboArray[] = [
                'id' => $crebo->id,
                'name' => $crebo->name,
                'crebo_number' => $crebo->crebo_number,
                'created_at' => $crebo->created_at->format('j-M Y')
            ];
        }

        $this->crebos = $creboArray;
    }

    public function mount()
    {
        $this->get_crebos();
    }

    public function startCreboDeletion($creboId): void
    {
        foreach ($this->crebos as $crebo) {
            if ($crebo['id'] !== $creboId) continue;

            $this->currentCrebo = $crebo;
            break;
        }

        $this->dispatch('open-modal', 'delete-crebo');
    }

    public function destroyCrebo(): void
    {
        if (!$this->currentCrebo) return;

        $amount = Student::where('crebo_id', $this->currentCrebo['id'])->count();

        if ($amount !== 0) {
            throw ValidationException::withMessages([
                'crebo' => "$amount student(s) still have this crebo"
            ]);
        }

        Crebo::destroy($this->currentCrebo['id']);

        $this->currentCrebo = null;
        $this->get_crebos();
        $this->dispatch('close-modal', 'delete-crebo');
    }

    public function createCrebo(): void
    {
        $input = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:255'],
            'crebo_number' => ['required', 'integer', 'max_digits:5', 'unique:crebos']
        ])->validate();

        Crebo::create([
            'name' => $input['name'],
            'crebo_number' => $input['crebo_number']
        ]);

        $this->get_crebos();
        $this->dispatch('close-modal', 'add-crebo');
    }

    public function render(): View
    {
        return view('livewire.pages.admin.crebos');
    }
}
