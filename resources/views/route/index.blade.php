@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Bem vindo!</h1>
            <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="mt-3">
                    <label for="url" class="form-label">Encurtar link</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="url" placeholder="Cole o link aqui" value="{{old('url')}}">
                        <button class="btn btn-primary" type="submit">Encurtar</button>
                    </div>
                </div>
            </form>
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
            @if($routes->isEmpty())
                <div class="mt-3">Nenhuma rota cadastrada.</div>
            @else
                <table class="table table-striped mt-3">
                    <thead>
                    <tr>
                        <th scope="col">Url</th>
                        <th scope="col">Url Encurtado</th>
                        <th scope="col" class="w-25 text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($routes as $route)
                        <tr>
                            <td><a class="text-primary">{{ $route->url }}</a></td>
                            <td><a class="text-success">{{ route('redirect', $route->slug) }}</a></td>
                            <td class="w-25 text-center">
                                <button class="btn btn-primary" id="copy_{{$route->id}}" value="{{ route('redirect', $route->slug) }}" onclick="copyToClipboard({{$route->id}})">Copiar</button>
                                <a href=""
                                   class="btn btn-info">Relatórios</a>
                                <form action="{{ route('destroy', $route->id) }}"
                                      method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
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
    function copyToClipboard(id) {
        const copyText = document.getElementById("copy_"+id);
        var textArea = document.createElement("textarea");
        textArea.value = copyText.value;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
        document.getElementById("copy_"+id).innerHTML = "Copiado!";
        setTimeout(() => {
            document.getElementById("copy_"+id).innerHTML = "Copiar";
        }, 2000);
    }
</script>
