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
                <p>Valor total de investimento: R$ {{ number_format($investimentos, 2, ',', '.') }}</p>
            </div>
            <div class="mt-3">
                <h3>Investidores</h3>
                @if($investidores->isEmpty())
                    <p>Nenhum investidor até o momento.</p>
                @else
                    <ul>
                        @foreach($investidores as $investidor)
                            <li>{{ $investidor->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            @if($proposta->status == 'aberto' && $proposta->valor == $investimentos)
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#finalizar">
                        Finalizar
                    </button>
                </div>
            @endif
        </div>

        <div class="modal fade" id="finalizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Você deseja finalizar esta proposta?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('company.withdraw') }}" method="post">
                            @csrf
                            <input type="hidden" name="proposta_id" value="{{ $proposta->id }}">
                            <div class="mb-3">
                                <p>O valor será movido para sua conta.</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Sim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
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
