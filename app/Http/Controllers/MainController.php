<?php

namespace App\Http\Controllers;

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
        echo "I'm creating a new note!";
   }

   public function editNote($id)
   {
        //$id = $this->decryptId($id);
        // carregar a nota com o id fornecido

        $id = operations::decryptId($id);
        echo " I'm editing the note with id = $id";
   }

   public function deleteNote($id)
   {
        //$id = $this->decryptId($id);
        // Aqui você normalmente excluiria a nota do banco de dados

        $id = operations::decryptId($id);
        echo " I'm deleting the note with id = $id";
   }


}
