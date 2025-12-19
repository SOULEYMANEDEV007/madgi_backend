@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-flex">
                        Emargements
                        <form action="{{getGuardedRoute('registrations.index')}}" method="get" class="d-flex">
                            <input type="hidden" name="type" value="{{$type}}">
                            <input type="date" id="dateInput" name="date" value="{{$date->format('Y-m-d')}}" class="form-control form-control-sm ml-3 mr-1">
                            <button class="btn btn-primary btn-xs">Rechercher</button>
                        </form>
                        @can(App\Models\Permission::REGISTER['EXPORT'])
                            <a href="{{getGuardedRoute('registrations-export', ['date' => $date ?? 'null'])}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-download"></i> Exporter</a>
                        @endcan
                        @if (!auth()->guard(\App\Models\Admin::$guard)->check())
                            <a href="{{getGuardedRoute('registrations.create')}}" class="btn btn-primary btn-sm mx-2">Ajouter</a>
                        @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{ getGuardedRoute('registrations.search') }}" method="GET" class="d-flex float-right">
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="hidden" name="date" value="{{$date->format('Y-m-d')}}">
                        <input type="text" name="search" placeholder="Saisir le mot clé" class="bg-gradient-default btn-sm" />
                        <button type="submit" class="btn btn-primary btn-sm">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        @if (auth()->guard(\App\Models\Admin::$guard)->check())
            <div class="container">
                <div class="row justify-content-end">
                    <div class="card">
                        @include('registrations.recap-table')
                    </div>
                </div>
            </div>
        @endif
        
        <div class="card">
            @include('registrations.table')
        </div>
    </div>

@endsection
