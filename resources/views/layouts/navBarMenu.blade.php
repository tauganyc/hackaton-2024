<div id="sidebar-wrapper">
    <div class="list-group list-group-flush" style="margin-top: 45px;">

        <a href="{{ route('extract') }}" class="list-group-item list-group-item-action">Extrato</a>
        <a href="{{ route('company') }}"  class="list-group-item list-group-item-action">Proposta</a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action">Sair</button>
        </form>
{{--        <a class="list-group-item list-group-item-action mt-3">Sair</a>--}}

    </div>
</div>
