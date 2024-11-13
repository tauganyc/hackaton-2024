<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Definindo a cor de fundo */
    body {
        background-color: #13459C;
    }

    /* Botão de login */
    .btn-login {
        background-color: #0D6EFD;
        border-color: #0D6EFD;
        color: #ffffff; /* Cor do texto branco */
    }

    /* Efeito de hover para o botão */
    .btn-login:hover {
        background-color: #0b5ed7;
        border-color: #0b5ed7;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <h4 class="card-title text-center mb-4 fw-bold">{{ __('Login') }}</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Endereço de E-mail -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-mail') }}</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">{{ __('Senha') }}</label>
                        <input id="senha" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="text-primary">
                            <a href="{{ route('register') }}" class="text-decoration-none">{{ __('Ainda não possui uma conta?') }}</a>
                        </div>
                    </div>


                    <!-- Remember Me -->
{{--                    <div class="block mt-4">--}}
{{--                        <label for="remember_me" class="inline-flex items-center">--}}
{{--                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}

                    <div class="flex items-center justify-end mt-4">

                        <div class="d-flex justify-content-between align-items-center">
                        <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>

                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                            {{ __('Entrar') }}
                        </button>
                    </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
