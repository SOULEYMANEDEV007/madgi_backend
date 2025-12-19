@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @php
                        $result = App\Models\Admin::find($leave->signatory_id);
                        $department = App\Models\Departement::find($leave->department_id);
                    @endphp
                    @if ($leave->w_admin == 1 && auth()->user()->role->id == 1) <h1>Avis de l'admin</span></h1>
                    @else <h1>Avis de <span class="bg-warning">{{!empty($result) ? $result->name : $department->name}}</span></h1>
                    @endif
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6 media">
                                    <img class="mr-3" src="{{$leave->user->photo != null ? $leave->user->photo : asset('/images/user.png')}}" width="30" height="30">
                                    <div class="media-body">
                                      <h5 class="mt-0">{{$leave->user->nom}}</h5>
                                      <h5 class="mt-0">{{$leave->user->email}}</h5>
                                      <h5 class="mt-0">{{$leave->user->tel}}</h5>
                                    </div>
                                </div>
                                <div class="col-5 media">
                                    <div class="media-body">
                                      <h5 class="mt-0">Date de début @if($leave->type_id == 1) du congé @else de l'absence @endif: <span class="bg-warning">{{$leave->start_date}}</span></h5>
                                      <h5 class="mt-0">Date de fin @if($leave->type_id == 1) du congé @else de l'absence @endif: <span class="bg-warning">{{$leave->end_date}}</span></h5>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="{{ getGuardedRoute('workers.show', [$leave->user->id]) }}" class='btn btn-primary btn-sm'>Voir le profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($leave, ['route' => [$guard . 'leaves.updateAppreciation', $leave->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('leaves.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('leaves.index', ['type' => request()->type]) }}" class="btn btn-default btn-sm"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
