@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Modifier le rôle <span class="bg-warning px-1">{{$role->name}}</span></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($role, ['route' => [$guard . 'roles.update', $role->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('roles.index') }}" class="btn btn-defaulty btn-sm"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
