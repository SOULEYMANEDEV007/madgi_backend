@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-flex">
                        Retraités
                        <form action="{{ getGuardedRoute('retirements-export') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm  ml-2">
                                <i class="fa fa-download"></i> Exporter
                            </button>

                            <a href="{{getGuardedRoute('retirements.create')}}" class="btn btn-primary btn-sm">
                                Ajouter
                            </a>

                            <input class="form-control form-control-sm" name="date" value="{{$date ?? 'null'}}" type="hidden" >

                            <input class="form-control form-control-sm" name="type" value="{{$type}}" type="hidden" >

                            <div class="row justify-content-start">
                                <input class="form-control form-control-sm" name="nom" value="{{ request('nom') }}" type="hidden">
                                <input class="form-control form-control-sm" name="statut" value="{{ request('statut') }}" type="hidden">
                                <input class="form-control form-control-sm" name="contact" value="{{ request('contact') }}" type="hidden">
                                <input class="form-control form-control-sm" name="matricule" value="{{ request('matricule') }}" type="hidden">
                                <input class="form-control form-control-sm" name="service" value="{{ request('service') }}" type="hidden">
                                <input class="form-control form-control-sm" name="age" value="{{ request('age') }}" type="hidden" min="1">
                                <input class="form-control form-control-sm" name="grade[]" value="{{ request('grade') }}" type="hidden">
                                <input class="form-control form-control-sm" name="anciennete" value="{{ request('anciennete') }}" type="hidden" min="1">
                                <input class="form-control form-control-sm" name="anciennete1" value="{{ request('anciennete1') }}" type="hidden" min="1">
                                <input class="form-control form-control-sm" name="genre" value="{{ request('genre') }}" type="hidden">
                                <input class="form-control form-control-sm" name="fonction" value="{{ request('fonction') }}" type="hidden">
                                <input class="form-control form-control-sm" name="site" value="{{ request('site') }}" type="hidden">
                                <input class="form-control form-control-sm" name="departement" value="{{ request('departement') }}" type="hidden">
                            </div>
                        </form>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card text-left">
            <div class="card-body">
                <form action="{{ getGuardedRoute('retirements.search', ['type' => $type]) }}" method="POST">
                    @csrf
                    <div class="row justify-content-start">
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="nom" value="{{ request('nom') }}" type="text" placeholder="Nom et Prenom(s)">
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="statut" value="{{ request('statut') }}" type="text" placeholder="Statut">
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="contact" value="{{ request('contact') }}" type="text" placeholder="Contact">
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="matricule" value="{{ request('matricule') }}" type="text" placeholder="Matricule">
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control form-control-sm" name="service" aria-label=".form-select-lg example">
                                <option value="null" selected disabled>Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @if(request('service') == $service->id) selected @endif>{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="age" value="{{ request('age') }}" type="number" min="1" placeholder="Age">
                        </div>
                        <div class="col-md-2 form-group">
                            {{-- <select class="form-control form-control-sm" name="grade" aria-label=".form-select-lg example">
                                <option value="null" selected disabled>Grade</option>
                                @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" @if(request('grade') == $grade->id) selected @endif>{{ $grade->name }}</option>
                                @endforeach
                            </select> --}}

                            <select class="select2 form-control form-control-sm" multiple="multiple" name="grade[]" data-placeholder="Grade">
                                @foreach ($grades as $item)
                                    <option value="{{$item->id}}" @if(is_array(old('grade')) && in_array($item->id, old('grade'))) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="date_entre_m"  value="{{ request('date_entre_m') }}" type="date" placeholder="Date d'entré MADGI">
                        </div> --}}
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="anciennete" value="{{ request('anciennete') }}" type="number" min="1" placeholder="Ancienneté >">
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="anciennete1" value="{{ request('anciennete1') }}" type="number" min="1" placeholder="Ancienneté =">
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control form-control-sm" name="genre" aria-label=".form-select-lg example">
                                <option value="null" selected disabled>Genre</option>
                                <option value="M" @if(request('genre') == 'M') selected @endif>HOMME</option>
                                <option value="F" @if(request('genre') == 'F') selected @endif>FEMME</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <input class="form-control form-control-sm" name="fonction"  value="{{ request('fonction') }}" type="text" placeholder="Fonction">
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control form-control-sm" name="site" aria-label=".form-select-lg example">
                                <option value="null" selected disabled>Site</option>
                                @foreach ($sites as $site)
                                <option value="{{ $site->id }}" @if(request('site') == $site->id) selected @endif>{{ $site->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control form-control-sm" name="departement" aria-label=".form-select-lg example">
                                <option value="null" selected disabled>Departement</option>
                                @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}" @if(request('departement') == $departement->id) selected @endif>{{ $departement->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                        </div>
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="d-flex">
                                    <h6 class="text-primary text-bold">
                                        <a href="{{getGuardedRoute('retirements.index')}}" class="text-primary">Total (pers). actif: {{$total}}</a>
                                    </h6>
                                    <h6 class="text-bold ml-5">
                                        <a href="{{getGuardedRoute('retirements.userDisable')}}" class="text-danger">Total (pers). inactif: {{$totalLock}}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            @include('retirements.table')
        </div>
    </div>

@endsection
