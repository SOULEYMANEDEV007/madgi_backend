@if (Route::is('admin.fixed.create') || Route::is('user.fixed.create'))
    <div class="col-md-4 mb-3">
        <label for="nom">Nom & prénoms</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" id="nom" value="{{old('nom')}}" placeholder="Saisir le nom et prénoms">
            @error('nom')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="email">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" placeholder="Saisir l'email">
            @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="tel">Contact</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-phone"></i>
                </span>
            </div>
            <input type="text" name="tel" class="form-control form-control-sm @error('tel') is-invalid @enderror" id="tel" value="{{old('tel')}}" placeholder="Saisir le contact">
            @error('tel')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="cnps">CNPS</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="cnps" class="form-control form-control-sm @error('cnps') is-invalid @enderror" id="cnps" value="{{old('cnps')}}" placeholder="Saisir le numéro de la cnps">
            @error('cnps')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="matricule">Matricule MADGI / FP</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="matricule" class="form-control form-control-sm @error('matricule') is-invalid @enderror" id="matricule" value="{{old('matricule')}}" placeholder="Saisir le matricule">
            @error('matricule')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="fonction">Fonction</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="fonction" class="form-control form-control-sm @error('fonction') is-invalid @enderror" id="fonction" value="{{old('fonction')}}" placeholder="Saisir la fonction">
            @error('fonction')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_occupation_p">Date d'occupation</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_occupation_p" class="form-control form-control-sm @error('date_occupation_p') is-invalid @enderror" id="date_occupation_p" value="{{old('date_occupation_p')}}" placeholder="Saisir la date d'occupation">
            @error('date_occupation_p')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="grade">Grade</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="grade" id="grade" class="custom-select custom-select-sm form-control @error('grade') is-invalid @enderror">
                <option selected disabled>Sélectionnez le grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
            @error('grade')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_entre_mad">Date d'entrée</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_entre_mad" class="form-control form-control-sm @error('date_entre_mad') is-invalid @enderror" id="date_entre_mad" value="{{old('date_entre_mad')}}" placeholder="Saisir la date d'entrée">
            @error('date_entre_mad')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_fonction">Date de fonction public</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_fonction" class="form-control form-control-sm @error('date_fonction') is-invalid @enderror" id="date_fonction" value="{{old('date_fonction')}}" placeholder="Saisir la date de fonction public">
            @error('date_fonction')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="start_date">Date de debut de contrat</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" placeholder="Saisir la date d'entrée">
            @error('start_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="end_date">Date de fin de contrat</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" placeholder="Saisir la date de fin de stage">
            @error('end_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="situation_matrim">Situation matrimoniale</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="situation_matrim" id="situation_matrim" class="custom-select custom-select-sm form-control @error('situation_matrim') is-invalid @enderror">
                <option selected disabled>Sélectionnez la situation</option>
                <option>Marié(e)</option>
                <option>Veu.f(ve)</option>
                <option>Célibataire</option>
            </select>
            @error('situation_matrim')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="site">Site</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="site" id="site" class="custom-select custom-select-sm form-control @error('site') is-invalid @enderror">
                <option selected disabled>Sélectionnez le site</option>
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
            @error('site')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="nombre_enfant">Nombre d'enfant</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="number" name="nombre_enfant" class="form-control form-control-sm @error('nombre_enfant') is-invalid @enderror" id="nombre_enfant" value="{{old('nombre_enfant')}}" placeholder="Saisir le nombre d'enfant">
            @error('nombre_enfant')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_naissance">Date de naissance</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_naissance" class="form-control form-control-sm @error('date_naissance') is-invalid @enderror" id="date_naissance" value="{{old('date_naissance')}}" placeholder="Saisir la date de naissance">
            @error('date_naissance')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="nombre_enfant">Âge</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <?php
                $now = date('Y-m-d');
                $date1 = new DateTime($now);
                $date2 = new DateTime(old('date_naissance'));
                $diff = $date1->diff($date2);
            ?>
            <input type="number" class="form-control form-control-sm" value="{{$diff->y}}" placeholder="Saisir le nombre d'enfant" disabled>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="departement">Départements</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="departement" id="departement" class="custom-select custom-select-sm form-control @error('departement') is-invalid @enderror">
                <option selected disabled>Sélectionnez le département</option>
                @foreach ($departments as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('departement')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="service">Services</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="service" id="service" class="custom-select custom-select-sm form-control @error('service') is-invalid @enderror">
                <option selected disabled>Sélectionnez le départment</option>
                @foreach ($services as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('service')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    {{-- <div class="col-md-4 mb-3">
        <label for="statut_mad">Statut</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="statut_mad" class="form-control form-control-sm @error('statut_mad') is-invalid @enderror" id="statut_mad" value="{{old('statut_mad')}}" placeholder="Saisir le statut mad">
            @error('statut_mad')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div> --}}
    <div class="col-md-4 mb-3">
        <label for="diplome">Diplôme</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="diplome" class="form-control form-control-sm @error('diplome') is-invalid @enderror" id="diplome" value="{{old('diplome')}}" placeholder="Saisir le diplome">
            @error('diplome')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="confession_relg">Confession réligieuse</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="confession_relg" class="form-control form-control-sm @error('confession_relg') is-invalid @enderror" id="confession_relg" value="{{old('confession_relg')}}" placeholder="Saisir la confession réligieuse">
            @error('confession_relg')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="custom-control custom-checkbox mt-5">
            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="is_register" @checked(old('is_register'))>
            <label for="customCheckbox2" class="custom-control-label">
                <strong>Cocher si cet utilisateur n'émarge pas</strong>
            </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="is_salarie">Type d'utilisateur (Salarié / Fonctionnaire / ...)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <select name="is_salarie" id="is_salarie" class="custom-select custom-select-sm form-control @error('is_salarie') is-invalid @enderror">
                <option selected disabled>Sélectionnez le type d'utilisateur</option>
                <option value="1">Salarié</option>
                <option value="2">Fonctionnaire</option>
                <option value="3">Collaborateurs extérieur</option>
                <option value="4">CDD</option>
                <option value="5">Mise en disponibilité</option>
            </select>
            @error('is_salarie')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div x-data="{nb: 1}" class="text-center mt-2">
            <label for="dropzone-file" class="dropzone-file">
                <img src="" class="image-preview" :id="`agentImagePreview${nb}`">
                <svg :id="`agentSvg${nb}`" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 50px; height: 50px;">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mt-4 mb-2 text-sm">
                    <span class="font-semibold">Cliquez pour télécharger</span> <br>
                    <span class="font-semibold">ou glisser-déposer</span>
                </p>
                <small>PNG, JPG ou JPEG (MAX. 10MB)</small>
                <input id="dropzone-file" type="file" name="pictures" class="custom-file-input"  x-on:change="previewAgentImage($event, 1)" :data-index="`${nb}`" />
            </label>
        </div>
    </div>
@else
    <div class="col-md-4 mb-3">
        <label for="nom">Nom & prénoms</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" id="nom" value="{{$fixed->nom}}" placeholder="Saisir le nom et prénoms">
            @error('nom')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="email">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" value="{{$fixed->email}}" placeholder="Saisir l'email">
            @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="tel">Contact</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-phone"></i>
                </span>
            </div>
            <input type="text" name="tel" class="form-control form-control-sm @error('tel') is-invalid @enderror" id="tel" value="{{$fixed->tel}}" placeholder="Saisir le contact">
            @error('tel')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="cnps">CNPS</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="cnps" class="form-control form-control-sm @error('cnps') is-invalid @enderror" id="cnps" value="{{$fixed->cnps}}" placeholder="Saisir le numéro de la cnps">
            @error('cnps')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="matricule">Matricule MADGI / FP</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="matricule" class="form-control form-control-sm @error('matricule') is-invalid @enderror" id="matricule" value="{{$fixed->matricule}}" placeholder="Saisir le matricule">
            @error('matricule')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="fonction">Fonction</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="fonction" class="form-control form-control-sm @error('fonction') is-invalid @enderror" id="fonction" value="{{$fixed->fonction}}" placeholder="Saisir la fonction">
            @error('fonction')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_occupation_p">Date d'occupation</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_occupation_p" class="form-control form-control-sm @error('date_occupation_p') is-invalid @enderror" id="date_occupation_p" value="{{$fixed->date_occupation_p}}" placeholder="Saisir la date d'occupation">
            @error('date_occupation_p')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="grade">Grade</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="grade" id="grade" class="custom-select custom-select-sm form-control @error('grade') is-invalid @enderror">
                <option selected disabled>Sélectionnez le grade</option>
                @foreach ($grades as $grade)
                    <option @if($fixed->grad != null && $grade->id == $fixed->grad->id) selected @endif value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
            @error('grade')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_entre_mad">Date d'entrée</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_entre_mad" class="form-control form-control-sm @error('date_entre_mad') is-invalid @enderror" id="date_entre_mad" value="{{$fixed->date_entre_mad}}" placeholder="Saisir la date d'entrée">
            @error('date_entre_mad')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_fonction">Date de fonction public</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_fonction" class="form-control form-control-sm @error('date_fonction') is-invalid @enderror" id="date_fonction" value="{{$fixed->date_fonction}}" placeholder="Saisir la date de fonction public">
            @error('date_fonction')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="start_date">Date de debut de contrat</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{$fixed->start_date}}" placeholder="Saisir la date d'entrée">
            @error('start_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="end_date">Date de fin de contrat</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{$fixed->end_date}}" placeholder="Saisir la date de fin de stage">
            @error('end_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="situation_matrim">Situation matrimoniale</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="situation_matrim" id="situation_matrim" class="custom-select custom-select-sm form-control @error('situation_matrim') is-invalid @enderror">
                <option selected disabled>Sélectionnez la situation</option>
                <option @if($fixed->situation_matrim == 'Marié' || $fixed->situation_matrim == 'Marié(e)') selected @endif>Marié(e)</option>
                <option @if($fixed->situation_matrim == 'Veu.f(ve)') selected @endif>Veu.f(ve)</option>
                <option @if($fixed->situation_matrim == 'Célibataire') selected @endif>Célibataire</option>
            </select>
            @error('situation_matrim')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="site">Site</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="site" id="site" class="custom-select custom-select-sm form-control @error('site') is-invalid @enderror">
                <option selected disabled>Sélectionnez le site</option>
                @foreach ($sites as $site)
                    <option @if($fixed->Sit != null && $site->id == $fixed->Sit->id) selected @endif value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
            @error('site')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="nombre_enfant">Nombre d'enfant</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="number" name="nombre_enfant" class="form-control form-control-sm @error('nombre_enfant') is-invalid @enderror" id="nombre_enfant" value="{{$fixed->nombre_enfant}}" placeholder="Saisir le nombre d'enfant">
            @error('nombre_enfant')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="date_naissance">Date de naissance</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="dateInput" name="date_naissance" class="form-control form-control-sm @error('date_naissance') is-invalid @enderror" id="date_naissance" value="{{$fixed->date_naissance}}" placeholder="Saisir la date de naissance">
            @error('date_naissance')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="nombre_enfant">Âge</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <?php
                $now = date('Y-m-d');
                $date1 = new DateTime($now);
                $date2 = new DateTime($fixed->date_naissance);
                $diff = $date1->diff($date2);
            ?>
            <input type="number" class="form-control form-control-sm" value="{{$diff->y}}" placeholder="Saisir le nombre d'enfant" disabled>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="departement">Départements</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="departement" id="departement" class="custom-select custom-select-sm form-control @error('departement') is-invalid @enderror">
                <option selected disabled>Sélectionnez le département</option>
                @foreach ($departments as $item)
                    <option @if($fixed->depart != null && $item->id == $fixed->depart->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('departement')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="service">Services</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-cubes"></i>
                </span>
            </div>
            <select name="service" id="service" class="custom-select custom-select-sm form-control @error('service') is-invalid @enderror">
                <option selected disabled>Sélectionnez le départment</option>
                @foreach ($services as $item)
                    <option @if($fixed->serv != null && $item->id == $fixed->serv->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('service')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    {{-- <div class="col-md-4 mb-3">
        <label for="statut_mad">Statut</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="statut_mad" class="form-control form-control-sm @error('statut_mad') is-invalid @enderror" id="statut_mad" value="{{$fixed->statut_mad}}" placeholder="Saisir le statut mad">
            @error('statut_mad')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div> --}}
    <div class="col-md-4 mb-3">
        <label for="diplome">Diplôme</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="diplome" class="form-control form-control-sm @error('diplome') is-invalid @enderror" id="diplome" value="{{$fixed->diplome}}" placeholder="Saisir le diplome">
            @error('diplome')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="confession_relg">Confession réligieuse</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="confession_relg" class="form-control form-control-sm @error('confession_relg') is-invalid @enderror" id="confession_relg" value="{{$fixed->confession_relg}}" placeholder="Saisir la confession réligieuse">
            @error('confession_relg')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="custom-control custom-checkbox mt-5">
            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="is_register" @checked($fixed->is_register)>
            <label for="customCheckbox2" class="custom-control-label">
                <strong>Cocher si cet utilisateur n'émarge pas</strong>
            </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="is_salarie">Type d'utilisateur (Salarié / Fonctionnaire / ...)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <select name="is_salarie" id="is_salarie" class="custom-select custom-select-sm form-control @error('is_salarie') is-invalid @enderror">
                <option selected disabled>Sélectionnez le type d'utilisateur</option>
                <option @if($fixed->is_salarie == 1) selected @endif value="1">Salarié</option>
                <option @if($fixed->is_salarie == 2) selected @endif value="2">Fonctionnaire</option>
                <option @if($fixed->is_salarie == 3) selected @endif value="3">Collaborateurs extérieur</option>
                <option @if($fixed->is_salarie == 4) selected @endif value="4">CDD</option>
                <option @if($fixed->is_salarie == 5) selected @endif value="5">Mise en disponibilité</option>
                <option @if($fixed->is_salarie == 6) selected @endif value="6">Retraité</option>
            </select>
            @error('is_salarie')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div x-data="{nb: 1}" class="text-center mt-2">
            <label for="dropzone-file" class="dropzone-file">
                <img src="" class="image-preview" :id="`agentImagePreview${nb}`">
                <svg :id="`agentSvg${nb}`" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 50px; height: 50px;">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mt-4 mb-2 text-sm">
                    <span class="font-semibold">Cliquez pour télécharger</span> <br>
                    <span class="font-semibold">ou glisser-déposer</span>
                </p>
                <small>PNG, JPG ou JPEG (MAX. 10MB)</small>
                <input id="dropzone-file" type="file" name="pictures" class="custom-file-input"  x-on:change="previewAgentImage($event, 1)" :data-index="`${nb}`" />
            </label>
        </div>
    </div>
@endif