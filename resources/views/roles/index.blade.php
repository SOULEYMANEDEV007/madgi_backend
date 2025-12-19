@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    @can(\App\Models\Permission::ROLE['CREATE'])
                        <a class="btn btn-primary btn-sm float-right"
                        href="{{ getGuardedRoute('roles.create') }}">
                            Ajouter
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('roles.table')
        </div>
    </div>

@endsection
