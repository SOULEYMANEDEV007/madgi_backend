@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Détail de l'employé <span class="bg-warning">{{$worker->nom}}</span></h1>
                    <a href="javascript:;" class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#create-document-modal">
                        <i class="fas fa-upload"></i> Ajouter un document
                    </a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary float-right btn-sm" href="{{ getGuardedRoute('workers.index') }}">Retour </a>
                </div>
            </div>
            @include('flash::message')

        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('workers.show_fields')
                </div>
            </div>
        </div>
    </div>

    @include('workers.modals.create')
@endsection
