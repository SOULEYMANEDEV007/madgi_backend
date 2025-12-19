<aside class="main-sidebar sidebar-dark-primary elevation-0">
    <a href="{{ getGuardedRoute('home') }}" class="brand-link">
        <img src="{{asset('images/logo1.png')}}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light text-orange">{{ config('app.title') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
