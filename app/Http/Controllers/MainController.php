<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Service\operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
   public function index()
   {
        // load user's notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();

        //show home view
        return view('home', ['notes' => $notes]);
   }

   public function newNote()
   {
        // show new note view
        return view('new_note');
   }

   public function newNoteSubmit(Request $request)
   {
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //error messages
            [
                'text_title.required' => 'O título é obrigatório.',
                'text_title.max' => 'O título deve ter no máximo :max caracteres.',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres.',
                'text_note.required' => 'A Nota é obrigatória.',
                'text_note.min' => 'A Nota deve ter pelo menos :min caracteres.',
                'text_note.max' => 'A Nota deve ter no máximo :max caracteres.'
            ]
        );

        //get user input
        $id = session('user.id');

        //create a new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home if note is saved
        return redirect()->route('home')
            ->with('success', 'Nota criada com sucesso!');


   }

   public function editNote($id)
   {
        $id = operations::decryptId($id);

        //load the note to edit
        $note = Note::find($id);

        //show edit note view
        return view('edit_note', ['note' => $note]);
   }

   public function editNoteSubmit(Request $request)
   {
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //error messages
            [
                'text_title.required' => 'O título é obrigatório.',
                'text_title.max' => 'O título deve ter no máximo :max caracteres.',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres.',
                'text_note.required' => 'A Nota é obrigatória.',
                'text_note.min' => 'A Nota deve ter pelo menos :min caracteres.',
                'text_note.max' => 'A Nota deve ter no máximo :max caracteres.'
            ]
        );

        //check if note id is valid
        if ($request->note_id == null) {
            return redirect()->route('home')
                ->with('error', 'Nota não encontrada.');
        }

        //get user input
        $id = operations::decryptId($request->note_id);

        //update the note
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home if note is updated
        return redirect()->route('home')
            ->with('success', 'Nota editada com sucesso!');
   }

   public function deleteNote($id)
    {
        try {
            $id = operations::decryptId($id);
        } catch (DecryptException $e) {
            return redirect()->route('home')->with('error', 'ID inválido para exclusão.');
        }

        $userId = session('user.id');

        // Busca a nota e garante que ela pertence ao usuário logado
        $note = Note::where('id', $id)->where('user_id', $userId)->first();

        if (!$note) {
            return redirect()->route('home')->with('error', 'Nota não encontrada ou não pertence a você.');
        }

        $note->delete();

        return redirect()->route('home')->with('success', 'Nota excluída com sucesso!');
    }

}
