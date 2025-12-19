@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Services
                        @can(App\Models\Permission::SERVICE['CREATE'])
                            <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-services-modal">
                                Ajouter
                            </a>
                        @endcan
                    </h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{ getGuardedRoute('services.search') }}" method="GET">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Valider</button>
                        <input type="text" name="search" placeholder="Saisir le mot clé" class="bg-gradient-default btn-sm float-right" />
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('services.table')
        </div>
    </div>

    @include('services.modals.create')

@endsection
