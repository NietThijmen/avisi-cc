<?php

namespace App\Http\Controllers;

use App\Models\StudentNote;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    const array VALIDATION_RULES = [
        'content' => ['string', 'max:2048'],
        'student_id' => ['integer', 'exists:students,id'],
    ];

    public function show(StudentNote $note)
    {
        if (! $note->read) $note->setAttribute('read', true)->save();

        return view('notes.show', compact('note'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(static::VALIDATION_RULES);

        $request->user()->data()->notes()->attach($validated);

        return redirect()->back()->with([
            'message' => __('Note created'),
        ]);
    }

    public function update(Request $request, StudentNote $note)
    {
        $validated = $request->validate(static::VALIDATION_RULES);

        $note->update($validated);

        return redirect()->back()->with([
            'message' => __('Note updated'),
        ]);
    }

    public function destroy(int $id)
    {
        StudentNote::where('id', $id)->delete();

        return redirect()->back()->with([
            'message' => __('Note deleted'),
        ]);
    }
}
