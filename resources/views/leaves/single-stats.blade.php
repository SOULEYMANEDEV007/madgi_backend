@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-end mb-2">
                <div class="col-md-10">
                    <h1>
                        Statistique de <span class="bg-warning">{{$user->nom}}</span>
                        @can(App\Models\Permission::REGISTER['EXPORT'])
                            <a href="{{getGuardedRoute('leaves-stats-single-export', $user->id)}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-download"></i> Exporter</a>
                        @endcan
                        <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-leave-modal">
                            Ajouter
                        </a>
                    </h1>
                </div>
                <div class="col-md-2 text-right">
                    <a class="btn btn-primary float-right btn-sm" href="{{ getGuardedRoute('leaves.stats') }}">Retour </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="leaves-table">
                        <thead>
                            <tr>
                                <th class="text-sm">Année</th>
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
                                        <span class="text-sm">{{$item['year']}}</span>
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
                                        <div x-data="{
                                            show($leave) {
                                                $('#update-leave-modal').modal('show');
                                                $('.leave-id').val($leave.id);
                                                $('.year-input').val($leave.year);
                                                $('.value-input').val($leave.value);
                                                $('.nb_use-input').val($leave.nb_use);
                                            },
                                        }" class='btn-group'>
                                            <a x-on:click="show({{$item['user_leave']}})" href="javascript:;" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {!! Form::open(['route' => [$guard . 'leaves.delete.year', $item['user_leave']->id], 'method' => 'delete']) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                            {!! Form::close() !!}
                                        </div>
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

    @include('leaves.modals.create-leave')
    @include('leaves.modals.update-leave')

@endsection
