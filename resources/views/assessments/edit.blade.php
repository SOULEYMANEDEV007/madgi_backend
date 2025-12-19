@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Grille de notation</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($factor, ['route' => [$guard . 'assessments.update', $factor->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('assessments.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('assessments.index') }}" class="btn btn-default btn-sm"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection