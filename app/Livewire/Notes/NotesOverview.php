<?php

namespace App\Livewire\Notes;

use App\Enums\Role;
use App\Models\StudentNote;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class NotesOverview extends Component
{
    use WithPagination;

    #[Locked]
    public User $user;

    public function mount(): void
    {
        $this->user = \Auth::guard('web')->user();
    }

    public function render()
    {
        return view('livewire.pages.notes.overview', [
            'notes' => $this->getNotesBuilder()->with(['teacher', 'student'])->paginate(5),
        ]);
    }

    public function toggleRead(int $id): void
    {
        abort_if($this->user->role !== Role::Student, 401);

        ($note = $this->getNotesBuilder()->findOrFail($id, ['id', 'read']))
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
