<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NoteController extends Controller
{

    public function index(string $id)
    {
        $decryptedNotesId =  Crypt::decrypt($id);
        $note = Note::find($decryptedNotesId);
        return view('notes.note-view', ['note' => $note]);
    }

    public function create()
    {
        return view('dashboard');
    }

    public function store(NoteRequest $request)
    {
        $file = $request->file('description');
        $CreatedNoteDetail = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'note_type' => $request->note_type,
            'share_link' => 'null',
        ]);
        if ($CreatedNoteDetail->note_type == 'public') {
            $CreatedNoteDetail->update([
                'share_link' => 'http://note.app.in/public/note/view/' . Crypt::encrypt($CreatedNoteDetail->id),
            ]);
        }
        return redirect('notes');
    }

    public function show()
    {
        $users = User::get();
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return view('notes.note-app', ['notes' => $notes, 'users' => $users]);
    }

    public function edit(string $id)
    {
        $note = Note::find($id);
        return view('notes.note-edit', ['note' => $note]);
    }

    public function update(Request $request, $id)
    {
        Note::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'note_type' => $request->note_type,
            'share_link' => 'null',
        ]);

        $UpdateNoteDetail = Note::find($id);

        if ($UpdateNoteDetail->note_type == 'public') {
            $UpdateNoteDetail->update([
                'share_link' => 'http://note.app.in/public/note/view/' . Crypt::encrypt($UpdateNoteDetail->id),
            ]);
        }

        return redirect('notes');
    }

    public function destroy(string $id)
    {
        Note::find($id)->delete();
        return redirect('notes');
    }

    public function shareNoteView(string $id)
    {
        $decryptedNotesId =  Crypt::decrypt($id);
        $note = Note::find($decryptedNotesId);
        return view('notes.note-view-share', ['note' => $note]);
    }
}
