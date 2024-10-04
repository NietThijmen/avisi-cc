<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Crebo;
use App\Models\EducationRubric;
use Livewire\Component;
use Validator;

class EditCrebo extends Component
{
    public Crebo $crebo;

    public $create = [];

    public function mount(Crebo $crebo): void
    {
        $this->crebo = $crebo;
    }

    public function createEducationRubric(): void
    {
        $input = Validator::make($this->create, [
            'name' => ['required', 'string', 'max:255']
        ])->validate();

        $educationRubric = EducationRubric::create([
            'name' => $input['name'],
            'crebo_id' => $this->crebo->id
        ]);

        $this->redirectRoute('admin.education-rubric.edit', [
            'educationRubric' => $educationRubric
        ]);
    }

    public function render()
    {
        return view('livewire.pages.admin.edit-crebo');
    }
}
