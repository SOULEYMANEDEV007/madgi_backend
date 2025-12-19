@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Documents administratifs</h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{ getGuardedRoute('certificates.search') }}" method="GET">
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
            <div class="card-body">
                <h5 class="pb-2">Demander un document administratif</h5>
                @include('certificates.create-fields')
            </div>
        </div>

        <div class="card">
            @include('certificates.table')
        </div>
    </div>

@endsection
