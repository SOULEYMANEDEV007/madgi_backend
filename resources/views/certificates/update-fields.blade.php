@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Modifier <span class="bg-warning">{{$certificate->type}}</span></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($certificate, ['route' => [$guard . 'certificates.doc-update', $certificate->id], 'method' => 'post']) !!}

            <div class="card-body">
                <div class="row">
                    @if(auth()->guard(\App\Models\Admin::$guard)->check())
                        @livewire('admin.update-certificat', [$certificate])
                    @else
                        @livewire('user.update-certificat', [$certificate])
                    @endif
                </div>
            </div>

            @if (auth()->guard(\App\Models\Admin::$guard)->check())
                @can(App\Models\Permission::CERTIFICAT['UPDATE'])
                    <div class="card-footer">
                        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm']) !!}
                        <a href="{{ getGuardedRoute('certificates.index') }}" class="btn btn-default btn-sm"> Annuler </a>
                    </div>
                @endcan
            @else
                <div class="card-footer">
                    {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm']) !!}
                    <a href="{{ getGuardedRoute('certificates.index') }}" class="btn btn-default btn-sm"> Annuler </a>
                </div>
            @endif


            {!! Form::close() !!}

        </div>
    </div>
@endsection
