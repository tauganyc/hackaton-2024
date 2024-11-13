@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Bem-vindo!</h1>
            <p>A força de uma pequena ou média empresa não se mede apenas pelos lucros ou pela quantidade de produtos
                que vende, mas pela coragem e resiliência de seus donos e colaboradores. E não há maior prova disso do
                que a capacidade de recomeçar depois de um desastre inesperado, como uma enchente que destrói tudo o que
                foi construído com tanto esforço e dedicação. Com isso, a Orange Investments traz uma forma lucrativa de
                colocar sua empresa de volta no mercado!</p>
        </div>
    </div>
@endsection

<script>
    setTimeout(function () {
        document.querySelector('.alert').remove();
    }, 3000);

    function copyToClipboard(id) {
        const copyText = document.getElementById("copy_" + id);
        var textArea = document.createElement("textarea");
        textArea.value = copyText.value;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
        document.getElementById("copy_" + id).innerHTML = "Copiado!";
        setTimeout(() => {
            document.getElementById("copy_" + id).innerHTML = "Copiar";
        }, 2000);
    }
</script>
