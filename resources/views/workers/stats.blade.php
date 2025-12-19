@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-flex">
                        Statistiques
                        @can(App\Models\Permission::WORKER['EXPORT'])
                            <a href="{{getGuardedRoute('workers-pdf')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-download"></i> Télécharger</a>
                        @endcan
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <h3 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">Point du personnel de la {{env('APP_TITLE')}} au mois {{$monthName}} {{$year}}</h3>
        @include('workers.stats-table')
    </div>

@endsection
