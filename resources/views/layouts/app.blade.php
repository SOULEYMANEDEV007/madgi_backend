<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar sticky-top navbar-expand navbar-white">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars text-light"></i></a>
                    </li>
                </ul>

                @if (isset($startOfWeek) && isset($endOfWeek))
                    <h5 class="text-white pt-1">Semaine du {{$startOfWeek->format('d/m/Y')}} au {{$endOfWeek->format('d/m/Y')}}</h5>
                @else
                    @php
                        $deadline = \App\Models\Setting::find(4)->value;
                        $check = \App\Models\Emargement::where('user_id', auth()->id())
                                                    ->whereMonth('date', \Carbon\Carbon::now()->month)
                                                    ->whereYear('date', \Carbon\Carbon::now()->year)
                                                    ->whereDate('date', '<=', \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m-') . $deadline)->format('Y-m-d'))
                                                    ->first();
                    @endphp
                    @if (!auth()->guard(\App\Models\Admin::$guard)->check() && !empty($check))
                        <h5 class="text-white pt-1">
                            Deadline de retard d'émargement: {{$deadline . \Carbon\Carbon::now()->format('/m/Y')}}.
                            <a href="{{getGuardedRoute('registrations.index', ['type' => 'unregistred'])}}" class="text-decoration-underline">Cliquez pour emarger</a>
                        </h5>
                    @endif
                @endif

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="{{asset('app-release.apk')}}">
                            <img src="{{asset('images/apk.png')}}" alt="" width="150" height="50" draggable="false">
                        </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/logo1.png')}}" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline text-light">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <li class="user-footer">
                                <a href="#" class="btn btn-danger btn-sm btn-flat float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>
                                <form id="logout-form" action="{{ getGuardedRoute('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @isset($slot) {{$slot}} @endisset

                @yield('content')
            </div>
        </div>
    </body>

    @push('page_css')
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    @endpush

    @push('page_scripts')
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>

        <script>
            $(function () {
                $('.select2').select2()
                $('.select2bs4').select2({
                theme: 'bootstrap4'
                })
            });
        </script>
    @endpush
</x-laravel-ui-adminlte::adminlte-layout>