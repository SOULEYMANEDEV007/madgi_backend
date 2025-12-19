@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détail du vacataire <span class="bg-warning">{{$temporaryWorker->nom}}</span></h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right btn-sm" href="{{ getGuardedRoute('temporary-workers.index') }}">Retour </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('temporary_workers.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
