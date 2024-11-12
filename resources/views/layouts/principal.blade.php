<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Link CDN para Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilo customizado para o layout -->
    <style>
        /* Estilos do wrapper e sidebar */
        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar-wrapper {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: #ffffff;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #ffffff;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
        }

        /* Estilos para o conteúdo principal */
        #page-content-wrapper {
            width: 100%;
            background-color: #f8f9fa;
        }

        /* Navbar personalizada */
        .navbar-custom {
            background-color: #007bff;
            color: #ffffff;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-item {
            color: #ffffff;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .dropdown-item:hover {
            color: #dfe6f1;
        }

        /* Sidebar oculto quando toggled */
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -250px;
        }
    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    @include('layouts.navBarMenu')

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <!-- Navbar -->
        @include('layouts.navBarTopo')

        <!-- Conteúdo Principal -->
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-body overflow-hidden p-lg-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link CDN para Bootstrap Bundle JS (com Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle the sidebar
    document.getElementById("menu-toggle").onclick = function () {
        document.getElementById("wrapper").classList.toggle("toggled");
    };
</script>
</body>
</html>
