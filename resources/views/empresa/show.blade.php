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

            <div class="mt-3">
                <h3>{{ $proposta->titulo }}</h3>
                <p>{{ $proposta->descricao }}</p>
                <p>Valor solicitado: R$ {{ number_format($proposta->valor, 2, ',', '.') }}</p>
                <p>Status: {{ $proposta->status }}</p>
                <p>Valor total de investimento: R$ {{ number_format($investimentos, 2, ',', '.') }}</p>
            </div>
        </div>
        @endsection

        <script>
            setTimeout(function () {
                document.querySelector('.alert').remove();
            }, 3000);
        </script>
