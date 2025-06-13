@extends('layouts.main_layout')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">EDIT NOTE</p>
                </div>
                <div class="col text-end">
                    <!-- Botão de cancelar com modal -->
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

            <!-- form -->
            <form action="{{ route('editNoteSubmit') }}" method="post">
                @csrf
                <input type="hidden" name="note_id" value="{{ Crypt::encrypt($note->id) }}">
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Note Title</label>
                            <input type="text" class="form-control bg-primary text-white" name="text_title" value="{{ old('text_title', $note->title) }}">
                            @error('text_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note Text</label>
                            <textarea class="form-control bg-primary text-white" name="text_note" rows="5">{{ old('text_note', $note->text) }}</textarea>
                            @error('text_note')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <!-- Botão que chama o modal -->
                        <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#cancelModal">
                            <i class="fa-solid fa-ban me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-secondary px-5">
                            <i class="fa-regular fa-circle-check me-2"></i>Update
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal de confirmação de cancelamento -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="cancelModalLabel">Cancelar Edição</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja cancelar a edição desta nota?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar editando</button>
                <a href="{{ route('home') }}" class="btn btn-danger">Sim, cancelar</a>
            </div>
        </div>
    </div>
</div>

@endsection
