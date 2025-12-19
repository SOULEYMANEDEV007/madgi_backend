@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @php
                        $req = request()->type == 'annuel' ? 1 : 2;
                        $type = \App\Models\TypeLeave::find($req);
                    @endphp

                    @if (request()->type == 'maternite') <h1>Demande de congé de maternité</h1>
                    @else <h1>{{$type->name}}</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => $guard . 'leaves.store', 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">

                <div class="row">
                    @include('leaves.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('leaves.index') }}" class="btn btn-default btn-sm"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
