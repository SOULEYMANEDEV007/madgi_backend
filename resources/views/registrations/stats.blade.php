@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-flex">
                        Statistiques
                        @can(App\Models\Permission::REGISTER['EXPORT'])
                            <a href="{{getGuardedRoute('registrations-stats-export', ['start' => $startOfWeek, 'end' => $endOfWeek])}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-download"></i> Exporter</a>
                        @endcan
                    </h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{getGuardedRoute('registrations.stats')}}" method="GET" class="d-flex float-right">
                        <div class="form-group">
                            <label for="">Date de début</label>
                            <input type="date" id="dateInput" name="start_date" value="{{$startOfWeek->format('Y-m-d')}}" class="form-control form-control-sm">
                        </div>

                        <div class="form-group mx-1">
                            <label for="">Date de fin</label>
                            <input type="date" id="dateInput" name="end_date" value="{{$endOfWeek->format('Y-m-d')}}" class="form-control form-control-sm">
                        </div>

                        <div class="form-group mt-2">
                            <button class="btn btn-primary btn-xs mt-4 py-1">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        {{-- <div class="card">
            @include('registrations.stats-table')
        </div> --}}

        <div class="card">
            <div class="row justify-content-between">
                <div class="col">
                    <h6 class="text-primary text-bold">Total: {{$total}}</h6>
                </div>
                <div class="col mb-4">
                    @if (auth()->guard(\App\Models\Admin::$guard)->check())
                        <div class="col-sm-12">
                            <form action="{{ getGuardedRoute('registrations.stats.search', ['start_date' => $startOfWeek, 'end_date' => $endOfWeek]) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Valider</button>
                                <input type="text" name="search" placeholder="Saisir le mot clé" class="bg-gradient-default btn-sm float-right" />
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="registrations-table">
                        <thead>
                            <tr>
                                <th class="text-sm">Nom & prénoms</th>
                                <th class="text-sm">Nb(heure). travail</th>
                                <th class="text-sm">Nb. retard</th>
                                <th class="text-sm">Nb. absence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $item)
                                <tr>
                                    <td>
                                        <span class="text-sm">{{$item['user']->nom}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['register']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['later']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['absences']}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $collections])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
