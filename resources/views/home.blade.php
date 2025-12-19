@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        @if (Auth::guard(\App\Models\Admin::$guard)->check())
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('workers.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #ff9f47ba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Personnel MADGI</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(1)->count() + App\Models\User::whereIsSalarie(2)->count() + App\Models\User::whereIsSalarie(3)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('employees.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #47ff53ba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Salarié</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(1)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('officials.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #5347ffba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Fonctionnaire</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(2)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('externals.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #ff9f47ba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Collaborateurs extérieur</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(3)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('fixed.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #47ff53ba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">CDD</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(4)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('availables.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #5347ffba;"><i class="fa fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mise en disponibilité</span>
                            <span class="info-box-number">{{App\Models\User::whereIsSalarie(5)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('interns.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #7d6958;"><i class="fas fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stagiaires</span>
                            <span class="info-box-number">{{App\Models\User::whereType(2)->count()}}</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ getGuardedRoute('temporary-workers.index') }}" class="info-box" style="color: #000;">
                        <span class="info-box-icon" style="background-color: #007bff;"><i class="fas fa-users text-light"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Vacataires</span>
                            <span class="info-box-number">{{\App\Models\User::whereType(3)->count()}}</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @can(App\Models\Permission::FACTOR['READ'])
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Derniers enregistré</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">8 nouveaux enregistré</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="users-list clearfix">
                                    @foreach ($users->paginate(8) as $user)
                                        <li>
                                            <img src="{{$user->photo != null ? $user->photo : asset('/images/user.png')}}" class="factor-img" style="width: 120px !important; height: 140px !important;" />
                                            <a class="users-list-name" href="#">{{$user->nom}}</a>
                                            <span class="users-list-date">{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{getGuardedRoute('factors.index')}}">Voir tous les utilisateurs</a>
                            </div>
                        </div>
                    @endcan

                    @can(App\Models\Permission::INFO['READ'])
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">5 dernières infos</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Emetteur</th>
                                                <th>Contact</th>
                                                <th>Poste</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($infos->paginate(5) as $key => $info)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>
                                                        <img src="{{!empty($info->media) ? $info->media->src : asset('/images/user.png')}}" width="50" height="50">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-light btn-sm">{{$info->post_name}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-secondary btn-sm">{{$info->post_phone}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-warning btn-sm">{{$info->department->name ?? ''}}</span>
                                                    </td>
                                                    <td  style="width: 120px">
                                                        <div class='btn-group'>
                                                            <a href="{{ getGuardedRoute('infos.show', [$info->id]) }}"
                                                            class='btn btn-primary btn-sm'>
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{getGuardedRoute('infos.index')}}">Voir toutes les infos</a>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="col-md-4">
                    <a href="{{getGuardedRoute('registrations.index')}}" class="info-box mb-3" style="background-color: #ff9f47ba;">
                        <span class="info-box-icon"><i class="fas fa-link text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-white">Emargements</span>
                        </div>
                    </a>
                    <a href="{{getGuardedRoute('import-personals.index')}}" class="info-box mb-3" style="background-color: #66c3ef;">
                        <span class="info-box-icon"><i class="fa fa-link text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-white">Importer du personnel</span>
                        </div>
                    </a>
                    <a href="{{getGuardedRoute('interns.index')}}" class="info-box mb-3" style="background-color: #7d6958;">
                        <span class="info-box-icon"><i class="fa fa-link text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-white">Stagiaires</span>
                        </div>
                    </a>
                    <a href="{{getGuardedRoute('temporary-workers.index')}}" class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fa fa-link"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-white">Vacataires</span>
                        </div>
                    </a>

                    @can(App\Models\Permission::WORKER['READ'])
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Employés récemment ajouté</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($users->whereType(1)->paginate(5) as $item)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" alt="Photo" class="img-size-50" />
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{$item->nom}} <span class="badge badge-warning float-right">{{$item->matricule}}</span></a>
                                                <span class="product-description">{{$item->tel}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{getGuardedRoute('workers.index')}}" class="uppercase">Voir tous les employés</a>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        @else
            <div class="card">
                <h6>Bonjour <span class="text-bold">{{Auth()->user()->name}}</span>, ravis de vous revoir</h6>
                <div class="container my-4">
                    @php
                        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                        $currentTime = \Carbon\Carbon::now()->format('H:i:s');
                        $qrCodeData = json_encode([
                            'Date' => $currentDate,
                            'Time' => $currentTime,
                            'matricule' => auth()->user()->matricule,
                            'type_device' => auth()->user()->type_device,
                        ]);
                    @endphp

                    {{-- <div class="header bg-orange-500 text-white py-4 px-6 rounded-b-lg">
                        <div class="text-center">
                            <h1 id="currentDate" class="text-xl text-dark">{{ $currentDate }}</h1>
                            <h2 id="currentTime" class="text-2xl text-dark">{{ $currentTime }}</h2>
                        </div>
                    </div> --}}

                    <div class="content mt-6 flex">
                        <div class="note-service flex-1 bg-white rounded-lg shadow-md p-4">
                            <h3 class="text-lg font-bold mb-4">EMARGER</h3>
                            <p>
                                Bienvenue à la MADGI le service des impots qui pense à votre bien-etre et votre épanouissement.
                                Soutien aux services sociaux: Les impôts financent les programmes sociaux tels que les prestations de retraite,
                                les soins de santé, les allocations familiales et le soutien aux personnes handicapées, ce qui contribue à renforcer la cohésion sociale et à protéger les populations les plus vulnérables.
                            </p>
                            <div class="qr-code flex-1 bg-white rounded-lg shadow-md p-4 text-center">
                                <h3 class="text-lg font-bold mb-4">SCANNEZ MOI!</h3>
                                <img id="qrCodeImg" src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode($qrCodeData) }}&size=320x320" alt="QR Code" class="mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Raccourcis <i class="fas fa-link"></i> </h5>
                <div class="row justify-content-between text-center border p-5">
                    <a class="col btn btn-gray p-5 mx-1" onclick="alert('Module en cours de développement')">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>Congés</p>
                    </a>
                    <a href="{{getGuardedRoute('certificates.index')}}" class="col btn btn-gray p-5">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Documents administratifs</p>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
