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

   public function deleteNote($id)
   {
        //$id = $this->decryptId($id);
        // Aqui você normalmente excluiria a nota do banco de dados

        $id = operations::decryptId($id);
        echo " I'm deleting the note with id = $id";
   }


}
