<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Página de Login</title>

    <style>
        /* Cor de fundo */
        body {
            background-color: #13459C;
        }

        /* Botão de login */
        .btn-login {
            background-color: #0D6EFD;
            border-color: #0D6EFD;
            color: #ffffff;
        }

        /* Efeito de hover para o botão */
        .btn-login:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }

        /* Ajuste de altura mínima para centralizar verticalmente */
        .min-vh-100 {
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-md-6 col-lg-4"> <!-- Coluna responsiva para o card -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <h4 class="card-title text-center mb-4 fw-bold">{{ __('Login') }}</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Campo de E-mail -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-mail') }}</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                               name="email" value="{{ old('email') }}" required autocomplete="username"/>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">{{ __('Senha') }}</label>
                        <input id="senha" class="form-control @error('password') is-invalid @enderror" type="password"
                               name="password" required autocomplete="new-password"/>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Link para registro -->
                    <div class="mb-3">
                        <div class="text-center">
                            <a href="{{ route('register') }}"
                               class="text-decoration-none text-primary">{{ __('Ainda não possui uma conta?') }}</a>
                        </div>
                    </div>

                    <!-- Botão de Login -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login rounded-pill py-2">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
