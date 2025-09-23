<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Notes logo">
        </a>
    </div>
    <div class="col text-center">
        Um Simples Projeto <span class="text-warning">LARAVEL</span>
    </div>
    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <span class="me-3">
                <i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i>{{ session('user.username') }}
            </span>

            <!-- Botão que abre o modal -->
            <button type="button" class="btn btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
            </button>
        </div>
    </div>
</div>

<hr>

<!-- Modal de confirmação para logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja sair da sua conta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="{{ route('logout') }}" class="btn btn-warning text-dark">Sim, sair</a>
            </div>
        </div>
    </div>
</div>


