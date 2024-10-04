<?php

namespace App\Livewire\Notes;

use App\Models\StudentNote;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    #[Locked] public StudentNote $note;

    public function render()
    {
        return view('livewire.notes.show');
    }
}
