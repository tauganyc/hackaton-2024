<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Estilos customizados -->
    <style>
        /* Remover margens e paddings extras */
        html, body {
            margin: 0;
            padding: 0;
            background-color: #CCE4FD;
            height: 100%; /* Garantir que o layout ocupe toda a altura da tela */
        }

        /* Estilos básicos */
        #wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
            position: relative;
            overflow-x: hidden; /* Impede rolagem horizontal */
        }

        /* Sidebar (menu lateral) */
        #sidebar-wrapper {
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            position: fixed; /* Menu fica fixo no lado da tela */
            top: 0;
            left: -250px; /* Menu começa fora da tela */
            height: 100%;
            transition: left 0.3s ease; /* Transição suave para o menu */
            z-index: 1050; /* Menu ficará sobre o conteúdo */
        }

        /* Cabeçalho do menu lateral */
        #sidebar-wrapper .sidebar-heading {
            background-color: #13459C; /* Cor de fundo igual à navbar */
            color: #ffffff;
            font-size: 1.25rem;
            padding: 1rem;
        }

        /* Itens do menu */
        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #ffffff;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
        }

        /* Botão de fechar no menu */
        #sidebar-wrapper #close-menu {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 20px;
            cursor: pointer;
        }

        /* Navbar personalizada */
        .navbar-custom {
            background-color: #13459C; /* Cor da navbar alterada para #13459C */
            color: #ffffff;
            padding: 0; /* Remover padding extra da navbar */
            margin: 0; /* Remover margens extras da navbar */
            position: fixed; /* Navbar fixa no topo */
            top: 0;
            left: 0;
            width: 100%; /* A navbar ocupa toda a largura */
            z-index: 1100; /* Garantir que a navbar fique acima do menu e do conteúdo */
            box-shadow: 0 4px 2px -2px gray; /* Um pequeno sombreado para destacar a navbar */
        }

        /* Evitar que o conteúdo da página empurre a navbar */
        #page-content-wrapper {
            width: 100%;
            padding-top: 60px; /* Adicionar espaço para a navbar fixa */
            transition: margin-left 0.3s ease;
        }

        /* Itens da navbar */
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-item {
            color: #ffffff;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .dropdown-item:hover {
            color: #dfe6f1;
        }

        /* Quando o menu estiver aberto, ele sobrepõe o conteúdo */
        #wrapper.toggled #sidebar-wrapper {
            left: 0; /* O menu aparece quando toggle */
        }

        /* Responsividade: Para telas pequenas (menor que 768px) */
        @media (max-width: 767px) {
            #sidebar-wrapper {
                left: -250px; /* Escondido inicialmente */
            }

            #page-content-wrapper {
                padding-top: 60px; /* Ajusta o espaço da navbar */
            }

            /* Navbar mobile */
            .navbar-custom .navbar-toggler {
                border-color: transparent;
            }

            .navbar-custom .navbar-toggler-icon {
                background-color: #ffffff; /* Ícone do menu na navbar */
            }

            /* Ajuste do conteúdo */
            #page-content-wrapper {
                width: 100%; /* O conteúdo ocupa toda a tela */
            }
        }

        /* Overlay (camada semitransparente) */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Fica atrás do menu, mas sobre o conteúdo */
        }

        /* Quando o menu estiver aberto, o overlay será mostrado */
        #wrapper.toggled #overlay {
            display: block;
        }

    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar (Menu lateral) -->
    @include('layouts.navBarMenu')

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <button class="btn me-2" id="menu-toggle">☰</button> <!-- Botão para abrir o menu -->
            <a class="navbar-brand" href="#">ApoiaPro</a>
        </nav>

        <!-- Conteúdo Principal -->
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-body overflow-hidden p-lg-6">
                    @yield('content') <!-- Conteúdo da página -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overlay (camada semitransparente) -->
<div id="overlay"></div>

<!-- Script para o Toggle do Menu -->
<script>
    // Abrir o menu
    document.getElementById("menu-toggle").onclick = function () {
        document.getElementById("wrapper").classList.toggle("toggled");
    };

    // Fechar o menu ao clicar no overlay
    document.getElementById("overlay").onclick = function () {
        document.getElementById("wrapper").classList.remove("toggled");
    };

    // Fechar o menu ao clicar no botão de fechar
    document.getElementById("close-menu").onclick = function () {
        document.getElementById("wrapper").classList.remove("toggled");
    };
</script>
</body>
</html>
