@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détail du retraité <span class="bg-warning">{{$retirement->nom}}</span></h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right btn-sm" href="{{ getGuardedRoute('retirements.index') }}">Retour </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('retirements.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
