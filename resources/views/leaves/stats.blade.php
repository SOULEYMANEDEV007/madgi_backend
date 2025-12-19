@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-flex">
                        Statistiques
                        @can(App\Models\Permission::REGISTER['EXPORT'])
                            <a href="{{getGuardedRoute('leaves-stats-export', ['start' => $startDate, 'end' => $endDate])}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-download"></i> Exporter</a>
                        @endcan
                    </h1>
                </div>
                <div class="col-sm-6">
                    <form action="{{getGuardedRoute('leaves.stats')}}" method="GET" class="d-flex float-right">
                        <div class="form-group">
                            <label for="">Date de début</label>
                            <input type="number" name="start_date" value="{{$startDate}}" max="2099" step="1" class="form-control form-control-sm" placeholder="YYYY">
                        </div>

                        <div class="form-group mx-1">
                            <label for="">Date de fin</label>
                            <input type="number" name="end_date" value="{{$endDate}}" max="2099" step="1" class="form-control form-control-sm" placeholder="YYYY">
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

        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col">
                        <h6 class="text-primary text-bold">Total: {{$all}}</h6>
                    </div>
                    <div class="col mb-4">
                        @if (auth()->guard(\App\Models\Admin::$guard)->check())
                            <div class="col-sm-12">
                                <form action="{{ getGuardedRoute('leaves.stats.search', ['start_date' => $startDate, 'end_date' => $endDate]) }}" method="GET">
                                    <button type="submit" class="btn btn-primary btn-sm float-right">Valider</button>
                                    <input type="text" name="search" placeholder="Saisir le mot clé" class="bg-gradient-default btn-sm float-right" />
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="leaves-table">
                        <thead>
                            <tr>
                                <th class="text-sm">Nom & prénoms</th>
                                <th class="text-sm">Nb(jours). total</th>
                                <th class="text-sm">Nb. utilisé</th>
                                <th class="text-sm">Nb. restant</th>
                                <th class="text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $item)
                                <tr>
                                    <td>
                                        <span class="text-sm">{{$item['user']->nom}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['total']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['leaves']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{$item['rest']}}</span>
                                    </td>
                                    <td>
                                        <a href="{{ getGuardedRoute('leaves.single', [$item['user']->id]) }}"
                                            class='btn btn-primary btn-sm'>
                                                <i class="far fa-eye"></i>
                                        </a>
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
