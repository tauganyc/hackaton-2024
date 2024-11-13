@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Bem vindo!</h1>

            TESTE
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
