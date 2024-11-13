@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            <div class="mt-3">
                <h2>Saldo atual: R$ {{ number_format($user->saldo, 2, ',', '.') }}</h2>
            </div>

            <div class="mt-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#depositar">
                    Depositar
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sacar">
                    Sacar
                </button>
            </div>
            <div class="mt-3">
                <h5>Últimos lançamentos</h5>
                @if($user->contas->isEmpty())
                    <div class="mt-3">Nenhum lançamento encontrado.</div>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>tipo</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->contas as $lancamento)
                            <tr>
                                <td>{{ date('d/m/Y H:i:s', strtotime($lancamento->created_at)) }}</td>
                                <td>{{ $lancamento->type }}</td>
                                <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal deposito-->
    <div class="modal fade" id="depositar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Depositar na conta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('extract.deposit') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" min="0.01" step="0.01" class="form-control" id="valor" name="valor">
                        </div>
                        <button type="submit" class="btn btn-primary">Depositar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal saque-->
    <div class="modal fade" id="sacar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sacar da conta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('extract.withdraw') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" min="0.01" step="0.01" class="form-control" id="valor" name="valor">
                        </div>
                        <button type="submit" class="btn btn-primary">Sacar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

            <script>
                setTimeout(function () {
                    document.querySelector('.alert').remove();
                }, 3000);
            </script>
