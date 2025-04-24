<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validatin (regras de validação do formulário)
        // rules
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            //error messages
            [
                'text_username.required' => 'O username é obrigatório.',
                'text_username.email' => 'O username deve ser um e-mail válido.',
                'text_password.required' => 'O password é obrigatório.',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres.',
                'text_password.max' => 'O password deve ter no máximo :max caracteres.'
            ]
        );

        //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        /*
        //test database connection
        try {
            DB::connection()->getPdo();
            echo 'Connection is OK!';
        } catch (\PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
        echo '<br>';
        echo 'Fim!';
        */

        //get all the users from the database
        $users = User::all()->toArray();

        echo '<pre>';
        print_r($users);
    }

    public function logout()
    {
        echo 'logout';
    }
}
