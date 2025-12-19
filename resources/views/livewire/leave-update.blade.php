<div>
    @if (!empty($userId))
        <div class="card-body mb-3">
            <h4>Statistique de <span class="bg-warning">{{$fullname}}</span></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center" id="leaves-table">
                    <thead>
                        <tr>
                            <th class="text-sm">Année</th>
                            <th class="text-sm">Nb(jours). total</th>
                            <th class="text-sm">Nb. utilisé</th>
                            <th class="text-sm">Nb. restant</th>
                            <th class="text-sm">Nb à retrancher</th>
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
                                    <input type="number" wire:model="leaveYear.{{$item['year']}}" name="leaveYear[{{$item['year']}}]" value="{{json_encode($leaveYear)}}" class="form-control form-control-sm" placeholder="Saisir le nb de congé à retrancher pour {{$item['year']}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="row justify-content-start">
        <input type="hidden" name="user_id" value="{{$userId}}">
        <input type="hidden" name="matricule" value="{{$matricule}}">
        <input type="hidden" name="path" class="form-control form-control-sm" value="{{$path}}" type="text" placeholder="{{$path}}">
        <div class="col-md-4 mb-3">
            <label for="fullname">Nom & prénoms</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input wire:model="fullname" type="text" name="fullname" class="form-control form-control-sm @error('fullname') is-invalid @enderror" id="fullname" value="{{$fullname}}" type="text" placeholder="{{$fullname}}" readonly>
                @error('fullname')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="type_id">Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-cubes"></i>
                    </span>
                </div>
                @php
                    $req = $path == 'annuel' ? 1 : 2;
                    $type = \App\Models\TypeLeave::find($req);
                @endphp

                @if ($path == 'maternite')
                    <input type="hidden" name="type_id" class="form-control form-control-sm @error('type_id') is-invalid @enderror" id="type_id" value="3" type="text" placeholder="3" readonly>
                    <input type="text" name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" id="type" value="Demande de congé de maternité" type="text" placeholder="Demande de congé de maternité" readonly>
                @else
                    <input type="hidden" name="type_id" class="form-control form-control-sm @error('type_id') is-invalid @enderror" id="type_id" value="{{$type->id}}" type="text" placeholder="{{$type->id}}" readonly>
                    <input type="text" name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" id="type" value="{{$type->name}}" type="text" placeholder="{{$type->name}}" readonly>
                @endif
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="department_id">Département</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-text-height"></i>
                    </span>
                </div>
                <input class="form-control form-control-sm" name="department" value="{{$department}}" type="text" placeholder="{{$department}}" readonly>
                <input class="form-control form-control-sm" name="department_id" value="{{$department_id}}" type="hidden" placeholder="{{$department_id}}" readonly>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="service_id">Service</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-text-height"></i>
                    </span>
                </div>
                <input class="form-control form-control-sm" name="service" value="{{$service}}" type="text" placeholder="{{$service}}" readonly>
                <input class="form-control form-control-sm" name="service_id" value="{{$service_id}}" type="hidden" placeholder="{{$service_id}}" readonly>
            </div>
        </div>
        <div id="start_date" class="col-md-4 mb-3">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input wire:model="startDate" type="date" id="dateInput" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{$startDate}}" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div id="end_date" class="col-md-4 mb-3">
            <label for="end_date">Date de fin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input wire:model="endDate" type="date" id="dateInput" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{$endDate}}" placeholder="Saisir la date d'entrée">
                @error('end_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div id="resumption" class="col-md-4 mb-3">
            <label for="resumption">Date de reprise</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input wire:model="resumption" type="date" id="dateInput" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" id="resumption" value="{{$resumption}}" placeholder="Saisir la date de reprise">
                @error('resumption')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($path != 'maternite')
            {{-- <div id="number_absence" class="col-md-4 mb-3">
                <label for="number_absence">Nombre de jours d'absence</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input type="number" id="number_absence" name="number_absence" class="d-none form-control form-control-sm @error('number_absence') is-invalid @enderror" id="number_absence" wire:model="number_absence" value="{{$number_absence}}" placeholder="Saisir le nombre de jours d'absence" min="1">
                    @error('number_absence')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div> --}}
            <div class="col-md-4 mb-3">
                <label for="place_enjoyment">Lieu de jouissance</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input wire:model="placeEnjoyment" type="text" name="place_enjoyment" class="form-control form-control-sm @error('place_enjoyment') is-invalid @enderror" id="place_enjoyment" value="{{$placeEnjoyment}}" placeholder="Saisir le lieu">
                    @error('place_enjoyment')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="call_user_name">Personne à contacter</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input wire:model="callUserName" type="text" name="call_user_name" class="form-control form-control-sm @error('call_user_name') is-invalid @enderror" id="call_user_name" value="{{$callUserName}}" placeholder="Saisir la personne à contacter">
                    @error('call_user_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="call_phone">Téléphone à contacter</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input wire:model="callPhone" type="text" name="call_phone" class="form-control form-control-sm @error('call_phone') is-invalid @enderror" id="call_phone" value="{{$callPhone}}" placeholder="Saisir le téléphone">
                    @error('call_phone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="interim">Intérime</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input wire:model="interim" type="text" name="interim" class="form-control form-control-sm @error('interim') is-invalid @enderror" id="interim" value="{{$interim}}" placeholder="Saisir l'intérime">
                    @error('interim')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <label for="motif">Motif</label>
                <div class="input-group">
                    <textarea wire:model="motif" name="motif" id="" cols="40" rows="6" class="form-control form-control-sm @error('motif') is-invalid @enderror motif-input-field" id="motif" placeholder="Saisir le contenu">{{$motif}}</textarea>
                    @error('motif')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @else
            <div id="duration" class="col-md-4 mb-3">
                <label for="duration">Durée</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-pen"></i>
                        </span>
                    </div>
                    <input type="number" id="duration" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" value="{{old('duration')}}" placeholder="Saisir la durée" min="1">
                    @error('duration')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
</div>
