<div class="row justify-content-start">
    <div class="col-md-4">
        <label for="matricule">Matricule</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="matricule" class="form-control form-control-sm @error('matricule') is-invalid @enderror" id="matricule" value="{{$certificate->matricule}}" placeholder="Saisir le matricule" disabled>
            @error('matricule')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="fullname">Nom & Prénoms</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="fullname" class="form-control form-control-sm @error('fullname') is-invalid @enderror" id="fullname" value="{{$certificate->fullname}}" placeholder="Saisir le nom complet" disabled>
            @error('fullname')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="department_id">Département</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="department" class="form-control form-control-sm @error('department') is-invalid @enderror" id="department" value="{{$certificate->department?->name}}" placeholder="Saisir le department_id" disabled>
            <input type="hidden" name="department_id" class="form-control form-control-sm @error('department_id') is-invalid @enderror" id="department_id" value="{{$certificate->department_id}}" placeholder="Saisir le department_id" disabled>
            @error('department_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    @if ($certificate->type == "Attestation allaitement")
        <div class="col-md-4 mb-3">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{$certificate->start_date}}" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="end_date">Date de fin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{$certificate->end_date}}" placeholder="Saisir la date de fin">
                @error('end_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="duration">Durée</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" value="{{$certificate->duration}}" placeholder="Saisir la durée">
                @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

    @elseif ($certificate->type == "Attestation de reprise de service maternité")
        <div class="col-md-4 mb-3">
            <label for="resumption">Date de reprise</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" id="resumption" value="{{$certificate->resumption}}" placeholder="Saisir la date de fin">
                @error('resumption')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="duration">Durée</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" value="{{$certificate->duration}}" placeholder="Saisir la durée">
                @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

    @elseif ($certificate->type == "Attestation travail")
        <div class="col-md-4 mb-3">
            <label for="work_date">Date d'admission au département</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="work_date" class="form-control form-control-sm @error('work_date') is-invalid @enderror" id="work_date" value="{{$certificate->work_date}}" placeholder="Saisir la date d'admission au département">
                @error('work_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @elseif ($certificate->type == "Certificat de travail")
        <div class="col-md-4 mb-3">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{$certificate->start_date}}" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="end_date">Date de fin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{$certificate->end_date}}" placeholder="Saisir la date de fin">
                @error('end_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="department_id">Fonction</label>
            <input class="form-control form-control-sm" value="{{$certificate->user?->fonction}}" type="text" placeholder="Saisir la fonction" readonly>
        </div>
    @elseif ($certificate->type == "Prise de service")
        <div class="col-md-4 mb-3">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{$certificate->start_date}}" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="site_id">Site</label>
            <div class="input-group mb-2">
                <select class="form-control form-control-sm" name="site_id" aria-label=".form-select-lg example">
                    <option value="null" selected disabled>Sélectionnez le site</option>
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}" @selected($certificate->site_id == $site->id)>{{ $site->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
</div>
