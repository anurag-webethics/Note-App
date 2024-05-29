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

    public function index()
    {
        // $users = User::get();
        //  'users' => $users;
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return view('notes.note-app', ['notes' => $notes]);
    }

    public function create()
    {
        return view('notes.note-add', ['note' => null]);
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
        return redirect('note');
    }

    public function show($id)
    {
        $note = Note::find($id);
        // if (isset($note) && $note->note_type == 'private') {
        //     if (isset(Auth::user()->id) && $note->user_id == Auth::user()->id) {
        //         return view('notes.note-view', ['note' => $note]);
        //     } else {
        //         return view('auth.login');
        //     }
        // } else {
        //     return view('notes.note-view', ['note' => $note]);
        // }
        if ($note->note_type === 'private') {
            if ($note->user_id !== auth()->id()) {
                return redirect()->route('notes.index');
            }
        }
        return view('notes.note-view', ['note' => $note]);
    }

    public function edit(string $id)
    {
        $note = Note::find($id);
        // return view('notes.note-edit', ['note' => $note]);
        return view('notes.note-add', ['note' => $note]);
    }

    public function update(Request $request, string $id)
    {
        $UpdateNoteDetail = Note::find($id);
        $UpdateNoteDetail->update([
            'title' => $request->title,
            'description' => $request->description,
            'note_type' => $request->note_type,
            'share_link' => 'null',
        ]);

        if ($UpdateNoteDetail->note_type == 'public') {
            $UpdateNoteDetail->update([
                'share_link' => 'http://note.app.in/public/note/view/' . Crypt::encrypt($UpdateNoteDetail->id),
            ]);
        }
        return redirect('note');
    }

    public function destroy(string $id)
    {
        Note::find($id)->delete();
        return redirect('note');
    }

    // public function shareNoteView(string $id)
    // {
    //     $decryptedNotesId =  Crypt::decrypt($id);
    //     $note = Note::find($decryptedNotesId);
    //     return view('notes.note-view-share', ['note' => $note]);
    // }
}
