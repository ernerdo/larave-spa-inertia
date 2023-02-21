<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class NoteController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Notes/Index', [
            'notes' => Note::where('created_by',$user->id)
                ->where('excerpt', 'LIKE', "%$request->q%")
                ->orderby('id','desc')
                ->get()
        ]);
    }


    public function create()
    {
        return Inertia::render('Notes/Create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'excerpt' => 'required',
            'content' => 'required',
        ]);
        $user = Auth::user();
        $note = Note::create([
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'created_by' => $user->id
        ]);

        return redirect()->route('notes.edit', $note->id)->with('status', 'Nota creada');
    }


    public function show(Note $note)
    {
        $user = Auth::user();
        if (is_null($note->user) || $note->user->id !== $user->id) {

            return redirect()->route('notes.index');
        }
        return Inertia::render('Notes/Show', compact('note',));
    }


    public function edit(Note $note)
    {
        $user = Auth::user();
        if (is_null($note->user) || $note->user->id !== $user->id) {

            return redirect()->route('notes.index');
        }
        return Inertia::render('Notes/Edit',compact('note'));
    }


    public function update(Request $request, Note $note)
    {

        $request->validate([
            'excerpt' => 'required',
            'content' => 'required',
        ]);
        $user = Auth::user();
        if (is_null($note->user) || $note->user->id !== $user->id) {

            return redirect()->route('notes.index');
        }

        $note->update($request->all());

        return redirect()->route('notes.index')->with('status','Nota actualizada');
    }


    public function destroy(Note $note)
    {
        $user = Auth::user();
        if (is_null($note->user) || $note->user->id !== $user->id) {

            return redirect()->route('notes.index');
        }

        $note->delete();

        return redirect()->route('notes.index')->with('status','Nota eliminada');
    }
}
