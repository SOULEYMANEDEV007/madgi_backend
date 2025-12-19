@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Détail du {{$certificate->type}} de <span class="bg-warning">{{$certificate->fullname}}</span></h1>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary float-right btn-sm" href="{{ getGuardedRoute('certificates.index') }}">Retour </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('certificates.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
