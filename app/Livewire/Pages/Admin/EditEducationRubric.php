<?php

namespace App\Livewire\Pages\Admin;

use App\Models\EducationRubric;
use Livewire\Component;

class EditEducationRubric extends Component
{
    public EducationRubric $educationRubric;

    public array $state;

    public function mount(EducationRubric $educationRubric): void
    {
        $this->educationRubric = $educationRubric;
        $this->state = $educationRubric->withoutRelations()->toArray();
    }

    public function editEducationRubric(): void
    {
        $input = \Validator::make($this->state, [
            'name' => ['required', 'string', 'max:255']
        ])->validate();

        $this->educationRubric->update([
            'name' => $input['name']
        ]);

        $this->dispatch('education-rubric-saved');
    }

    public function render()
    {
        return view('livewire.pages.admin.edit-education-rubric', [
            'crebo' => $this->educationRubric->crebo
        ]);
    }
}
