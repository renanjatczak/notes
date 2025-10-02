@extends('layouts.main_layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <div class="text-center p-3">
                        <img src="assets/images/logo.png" alt="Notes logo">
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="{{ route('registerSubmit') }}" method="post" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="text_username" class="form-label">E-MAIL</label>
                                    <input type="email" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}" required>
                                    @error('text_username')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_password" class="form-label">SENHA</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                                    @error('text_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_password_confirmation" class="form-label">CONFIRMAR SENHA</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password_confirmation" required>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100">CRIAR CONTA</button>
                                </div>
                            </form>

                            <div class="text-center mt-2">
                                <a href="/login" class="text-secondary">Já tem conta? Faça login</a>
                            </div>

                        </div>
                    </div>

                    <div class="text-center text-secondary mt-3">
                        <small>&copy; <?= date('Y') ?> Notes</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
