<div>
    <div class="row justify-content-start">
        <div class="col-md-3">
            <label for="matricule">Matricule</label>
            <div class="input-group">
                <input wire:model="matricule" class="form-control form-control-sm" name="matricule" type="text" placeholder="Matricule" required>
                <div wire:click="search" class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 form-group">
            <label for="fullname">Nom et prénoms</label>
            <input class="form-control form-control-sm" name="fullname" value="{{$fullname}}" type="text" placeholder="{{$fullname}}" readonly>
        </div>
        <div class="col-md-3 form-group">
            <label for="department_id">Département</label>
            <input class="form-control form-control-sm" name="department" value="{{$department}}" type="text" placeholder="{{$department}}" readonly>
            <input class="form-control form-control-sm" name="department_id" value="{{$department_id}}" type="hidden" placeholder="{{$department_id}}" readonly>
        </div>
        <div class="col-md-3 form-group">
            <label for="type">Type de certificat</label>
            <select id="type" name="type" class="form-control form-control-sm @error('type') is-invalid @enderror">
                <option selected disabled>Selectionnez le type de certificat</option>
                <option value="Attestation allaitement">Attestation allaitement</option>
                <option value="Attestation de reprise de service maternité">Attestation de reprise de service maternité</option>
                <option value="Attestation travail">Attestation travail</option>
                <option value="Certificat de travail">Certificat de travail</option>
                {{-- <option value="Décision autorisation d'absence">Décision autorisation d'absence</option>
                <option value="Décision de congé">Décision de congé</option> --}}
                {{-- <option value="Modèle demande d'autorisation d'absence codifiée">Modèle demande d'autorisation d'absence codifiée</option>
                <option value="Modèle demande de congé codifiée">Modèle d emande de congé codifiée</option> --}}
                <option value="Prise de service">Prise de service</option>
            </select>
            @error('type')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3 mb-3 d-none allaitement">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mb-3 d-none allaitement">
            <label for="end_date">Date de fin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" placeholder="Saisir la date de fin">
                @error('end_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mb-3 d-none allaitement">
            <label for="duration">Durée</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" placeholder="Saisir la durée">
                @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-3 mb-3 d-none service_maternite">
            <label for="resumption">Date de reprise</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" id="resumption" placeholder="Saisir la date de fin">
                @error('resumption')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mb-3 d-none service_maternite">
            <label for="duration">Durée</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" placeholder="Saisir la durée">
                @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-3 mb-3 d-none attestation_travail">
            <label for="work_date">Date d'admission au département</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="work_date" class="form-control form-control-sm @error('work_date') is-invalid @enderror" id="work_date" placeholder="Saisir la date d'admission au département">
                @error('work_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-3 mb-3 d-none certificat_travail">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mb-3 d-none certificat_travail">
            <label for="end_date">Date de fin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" placeholder="Saisir la date de fin">
                @error('end_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3 d-none certificat_travail">
            <label for="department_id">Fonction</label>
            <input class="form-control form-control-sm" value="{{$function}}" type="text" placeholder="{{$function}}" readonly>
        </div>

        {{-- <div class="col-md-4 mb-3 d-none autorisation_absence">
            <label for="duration">Durée</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" name="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror" id="duration" placeholder="Saisir la durée">
                @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3 d-none autorisation_absence">
            <label for="start_date">Date d'absence</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" placeholder="Saisir la date de fin">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3 d-none autorisation_absence">
            <label for="resumption">Date de reprise</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" id="resumption" placeholder="Saisir la date de fin">
                @error('resumption')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3 d-none autorisation_absence">
            <label for="motif">Motif</label>
            <div class="input-group">
                <textarea name="motif" id="" cols="40" rows="6" class="form-control form-control-sm @error('motif') is-invalid @enderror motif-input-field" id="motif" placeholder="Saisir le contenu">{{old('motif')}}</textarea>
                @error('motif')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div> --}}

        <div class="col-md-3 mb-3 d-none prise_service">
            <label for="start_date">Date de debut</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" placeholder="Saisir la date d'entrée">
                @error('start_date')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mb-3 d-none prise_service">
            <label for="site_id">Site</label>
            <div class="input-group mb-2">
                <select class="form-control form-control-sm" name="site_id" aria-label=".form-select-lg example">
                    <option value="null" selected disabled>Sélectionnez le site</option>
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
