@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Proposta</h1>
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
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            <div class="mt-3">
                <h3>{{ $proposta->titulo }}</h3>
                <p>{{ $proposta->descricao }}</p>
                <p>Valor solicitado: R$ {{ number_format($proposta->valor, 2, ',', '.') }}</p>
                <p>Status: {{ $proposta->status }}</p>
                <p>Valor já arrecadado: R$ {{ number_format($investimentos, 2, ',', '.') }}</p>
                <p>Você já investiu: R$ {{ number_format($investidor_investiu, 2, ',', '.') }}</p>
            </div>
            @if($proposta->status == 'aberto' && $proposta->valor > $investimentos)
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#investir">
                        Investir
                    </button>
                </div>
            @endif
        </div>

        <div class="modal fade" id="investir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Investir nesta proposta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('investor.invest') }}" method="post">
                            @csrf
                            <input type="hidden" name="proposta_id" value="{{ $proposta->id }}">
                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="number" min="0.01" step="0.01" class="form-control" id="valor" name="valor" required>
                            </div>
                            <div class="mb-3">
                                <div class="text-sm text-small small">Seu saldo atual: R$ {{ number_format($user->saldo, 2, ',', '.') }}</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Investir</button>
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
