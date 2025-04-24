@extends('layouts.mainLayout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <!-- logo -->
                    <div class="text-center p-3">
                        <img src="assets/images/logo.png" alt="Notes logo">
                    </div>

                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="/loginSubmit" method="post" novalidate> <!-- O atributo 'action' define para onde os dados do formulário serão enviados quando o método POST for executado -->

                                @csrf <!-- CSRF (Cross-Site Request Forgery) é um método de proteção contra ataques que forçam ações indesejadas em aplicações web.
                                    No Laravel, usamos csrf nos formulários para garantir que a requisição foi feita pelo usuário autenticado. -->

                                <div class="mb-3">
                                    <label for="text_username" class="form-label">Username</label>
                                    <input type="email" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}" required>

                                    {{-- Show Error -> indica o erro abaixo de cada form, no caso, campo vazio. --}}

                                    @error('text_username') {{-- funciona da mesma forma que if else --}}
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="text_password" class="form-label">Password</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password" value="{{ old('text_password') }}" required>

                                    {{-- Show Error -> indica o erro abaixo de cada form, no caso, campo vazio. --}}

                                    @error('text_password') {{-- funciona da mesma forma que if else --}}
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">LOGIN</button>
                                </div>
                            </form>

                            <!-- Message Error (Usarname ou Password incorretos ou insexistente) -->
                            @if (session('loginError'))
                                <div class="alert alert-danger text-center">
                                    {{ session('loginError') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                        <small>&copy; <?= date('Y') ?> Notes</small>
                    </div>

                    {{-- errors -> apresenta os erros abaixo do form, que são os campos vazios. --}}

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>
@endsection
