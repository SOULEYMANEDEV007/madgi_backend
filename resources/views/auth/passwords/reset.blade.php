<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Vous n'êtes qu'à un pas de votre nouveau mot de passe, récupérez votre mot de passe
                        maintenant.</p>

                    <form action="{{ str_contains(request()->url(), 'admin') ? route('admin.password.update') : route('user.password.update') }}" method="POST">
                        @csrf

                        @php
                            if (!isset($token)) {
                                $token = \Request::route('token');
                            }
                        @endphp

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-3">
                            <input type="email" name="email"
                                class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control form-control-sm{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control form-control-sm"
                                placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span
                                    class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Réinitialisation</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="{{ getGuardedRoute("login") }}">Se connecter</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
