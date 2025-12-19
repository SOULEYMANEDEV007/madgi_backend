@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        {{request()->type == 'absence' ? "Autorisation d'absence" : (request()->type == 'annuel' ? 'Demande de congé annuel' : 'Congé de maternité')}}
                        <a href="{{getGuardedRoute('leaves.create', ['type' => request()->type])}}" class="btn btn-primary btn-sm">
                            Ajouter
                        </a>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{ getGuardedRoute('leaves.search') }}" method="GET">
                        <input type="hidden" name="type" value="{{request()->type}}">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Valider</button>
                        <input type="text" name="search" placeholder="Saisir le mot clé" class="bg-gradient-default btn-sm float-right" />
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('leaves.table')
        </div>
    </div>

@endsection
