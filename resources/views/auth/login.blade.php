<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{asset('assets/logo.png')}}" class="user-image img-circle" alt="User Image" width="100">
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>

                    <form method="post" action="{{ str_contains(request()->url(), 'admin') ? route('admin.login') : route('user.login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Numéro de téléphone ou Email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" placeholder="Password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="col-7">
                                <a href="{{getGuardedRoute('password.request')}}" class="text-sm">Mot de passe oublié ?</a>
                            </div>

                            <div class="col-5">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Connexion</button>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <a href="{{asset('app-release.apk')}}" class="mt-4">Cliquez ici pour télécharger l'application MADGI</a>
        <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
