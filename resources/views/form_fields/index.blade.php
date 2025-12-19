@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulaires</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm float-right" href="{{ getGuardedRoute('form-fields.create') }}">Ajouter</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('form_fields.table')
        </div>
    </div>

@endsection
