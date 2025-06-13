<div class="row">
    <div class="col">
        <div class="card p-4">
            <div class="row">
                <div class="col">
                    <h4 class="text-info">{{ $note['title'] }}</h4>
                    <small class="text-secondary">
                        <span class="opacity-75 me-2">Created at:</span>
                        <strong>{{ date('Y-m-d H:i:s', strtotime($note['created_at'])) }}</strong>
                    </small>

                    @if($note['created_at'] != $note['updated_at'])
                        <small class="text-secondary ms-5">
                            <span class="opacity-75 me-2">Updated at:</span>
                            <strong>{{ date('Y-m-d H:i:s', strtotime($note['updated_at'])) }}</strong>
                        </small>
                    @endif
                </div>

                <div class="col text-end">
                    <!-- Botão de edição -->
                    <a href="{{ route('edit', ['id' => Crypt::encrypt($note['id'])]) }}" class="btn btn-outline-secondary btn-sm mx-1">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <!-- Botão que abre o modal de exclusão -->
                    <button type="button" class="btn btn-outline-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $note['id'] }}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <hr>
            <p class="text-secondary">{{ $note['text'] }}</p>
        </div>
        <br>
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="deleteModal{{ $note['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $note['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $note['id'] }}">Confirmar exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir a nota <strong>"{{ $note['title'] }}"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="{{ route('delete', ['id' => Crypt::encrypt($note['id'])]) }}" class="btn btn-danger">Sim, excluir</a>
            </div>
        </div>
    </div>
</div>
