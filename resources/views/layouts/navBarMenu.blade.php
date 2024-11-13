<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <a href="" class="text-white">Sistema</a>
    </div>
    <div class="list-group list-group-flush">
        <a href="" class="list-group-item list-group-item-action bg-white text-dark">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('company') }}" class="list-group
        item list-group-item-action bg-white text-dark">
            <i class="fas fa-building"></i> Proposta
        </a>
        <a href="{{ route('company.create') }}" class="list-group
        item list-group-item-action bg-white text-dark">
            <i class="fas fa-plus"></i> Nova proposta
        </a>
    </div>
</div>
