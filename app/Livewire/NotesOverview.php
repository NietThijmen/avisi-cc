<?php

namespace App\Livewire;

use App\Enums\Role;
use App\Models\StudentNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class NotesOverview extends Component
{
    use WithPagination;

    #[Locked]
    public Model $user;

    public function mount(): void
    {
        $this->user = \Auth::guard('web')->user();
    }

    public function render()
    {
        return view('livewire.notes-overview', [
            'notes' => $this->getNotesBuilder()->paginate(),
        ]);
    }

    // TODO: Dit breekt Livewire op een of andere manier...
    public function toggleRead(int $id): void
    {
        abort_if($this->user->role !== Role::Student, 401);

        ($note = $this->getNotesBuilder()->findOrFail($id, ['read']))
            ->setAttribute('read', !$note->read)
            ->saveOrFail();
    }

    protected function getNotesBuilder(): Builder
    {
        return match ($role = $this->user->role) {
            Role::Student => StudentNote::where('student_id', $this->user->id),
            Role::Teacher => StudentNote::where('teacher_id', $this->user->id),
            default => throw new \Exception(sprintf("A(n) [%s::%s] can not view notes", Role::class, $role->name)),
        };
    }
}
