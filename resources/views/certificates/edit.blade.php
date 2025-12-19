@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Avis du <span class="bg-warning">RH</span></h1>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6 media">
                                    <img class="mr-3" src="{{$certificate->user->photo != null ? $certificate->user->photo : asset('/images/user.png')}}" width="30" height="30">
                                    <div class="media-body">
                                      <h5 class="mt-0">{{$certificate->user->nom}}</h5>
                                      <h5 class="mt-0">{{$certificate->user->email}}</h5>
                                      <h5 class="mt-0">{{$certificate->user->tel}}</h5>
                                    </div>
                                </div>
                                <div class="col-5 media">
                                    <div class="media-body">
                                      <h5 class="mt-0">Date de demande du certificat: <span class="bg-warning">{{$certificate->start_date}}</span></h5>
                                      <h5 class="mt-0">Date de traitement: <span class="bg-warning">{{$certificate->end_date}}</span></h5>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="{{ getGuardedRoute('workers.show', [$certificate->user->id]) }}" class='btn btn-primary btn-sm'>Voir le profil</a>
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

            {!! Form::model($certificate, ['route' => [$guard . 'certificates.update', $certificate->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('certificates.fields')
                </div>
            </div>

            @can(App\Models\Permission::CERTIFICAT['UPDATE'])
                <div class="card-footer">
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                    <a href="{{ getGuardedRoute('certificates.index') }}" class="btn btn-default btn-sm"> Annuler </a>
                </div>
            @endcan

            {!! Form::close() !!}

        </div>
    </div>
@endsection
