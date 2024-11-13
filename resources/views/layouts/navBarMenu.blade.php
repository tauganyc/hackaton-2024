<div id="sidebar-wrapper">
    <div class="list-group list-group-flush" style="margin-top: 45px;">

        <a href="{{ route('extract') }}" class="list-group-item list-group-item-action">Extrato</a>

        @if(auth()->user()->can('empresa'))
            <a href="{{ route('company') }}" class="list-group-item list-group-item-action">Proposta</a>

        @endif
        @if(auth()->user()->can('investidor'))
            <a href="{{ route('investor') }}" class="list-group-item list-group-item-action">Investir</a>

        @endif
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action">Sair</button>
            </form>
            {{--        <a class="list-group-item list-group-item-action mt-3">Sair</a>--}}

    </div>
</div>
