<?php

namespace App\Livewire\Pages\Admin;

use App\Models\EducationRubric;
use Livewire\Component;

class EditEducationRubric extends Component
{
    public EducationRubric $educationRubric;
    public function mount(EducationRubric $educationRubric): void
    {
        $this->educationRubric = $educationRubric;
    }

    public function render()
    {
        return view('livewire.pages.admin.edit-education-rubric');
    }
}
