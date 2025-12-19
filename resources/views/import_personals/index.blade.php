@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Importer un fichier</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => $guard . 'import-personals.store', 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">

                <div class="row">
                    @include('import_personals.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('import-personals.index') }}" class="btn btn-default btn-sm"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
