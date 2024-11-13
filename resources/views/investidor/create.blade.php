@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Fazer proposta</h1>
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

            <form method="POST" action="{{ route('company.store') }}">
                @csrf
                <div class="form-group mt-3">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="form-group
                mt-3">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                </div>
                <div class="form-group
                mt-3">
                    <label for="valor">Valor solicitado</label>
                    <input type="number" class="form-control" id="valor" name="valor" min="0.01" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Enviar proposta</button>
            </form>
        </div>
    </div>
@endsection

<script>
    setTimeout(function () {
        document.querySelector('.alert').remove();
    }, 3000);
</script>
