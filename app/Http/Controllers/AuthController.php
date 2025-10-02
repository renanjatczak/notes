<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // Validação do login
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_username.required' => 'O username é obrigatório.',
                'text_username.email' => 'O username deve ser um e-mail válido.',
                'text_password.required' => 'O password é obrigatório.',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres.',
                'text_password.max' => 'O password deve ter no máximo :max caracteres.'
            ]
        );

        // Buscar usuário
        $user = User::where('username', $request->text_username)
            ->where('deleted_at', NULL)
            ->first();

        if(!$user || !password_verify($request->text_password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError','Username ou Password incorreto.');
        }

        // Atualizar último login
        $user->last_login = now();
        $user->save();

        // Criar sessão
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        return redirect()->to('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        // Validação do cadastro
        $request->validate(
            [
                'text_username' => 'required|email|unique:users,username',
                'text_password' => 'required|min:6|max:16|confirmed'
            ],
            [
                'text_username.required' => 'O e-mail é obrigatório.',
                'text_username.email' => 'O e-mail deve ser válido.',
                'text_username.unique' => 'Este e-mail já está em uso.',
                'text_password.required' => 'O password é obrigatório.',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres.',
                'text_password.max' => 'O password deve ter no máximo :max caracteres.',
                'text_password.confirmed' => 'As senhas não coincidem.'
            ]
        );

        // Criar novo usuário
        User::create([
            'username' => $request->text_username,
            'password' => password_hash($request->text_password, PASSWORD_DEFAULT),
            'last_login' => null,
        ]);

        return redirect()->to('/login')->with('success', 'Conta criada com sucesso! Faça login para continuar.');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login');
    }
}
