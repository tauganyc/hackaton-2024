@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Propostas abertas</h1>
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
            @if($propostas->isEmpty())
                <div class="mt-3">Nenhuma proposta foi encontrada.</div>
            @else
                <table class="table table-striped mt-3">
                    <thead>
                    <tr>
                        <th scope="col">Solicitante</th>
                        <th scope="col">Título</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="w-25 text-center">Valor solicitado</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($propostas as $proposta)
                        <tr>
                            <td>{{$proposta->name}}</td>
                            <td>{{ $proposta->titulo }}</td>
                            <td class="text-success">{{ $proposta->status }}</td>
                            <td class="text-center">R$ {{ number_format($proposta->valor, 2, ',', '.') }}</td>
                            <td class="w-25 text-center">
                                <a href="{{ route('investor.show', $proposta->id) }}"
                                   class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

<script>
    setTimeout(function () {
        document.querySelector('.alert').remove();
    }, 3000);
</script>
