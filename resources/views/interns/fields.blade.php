@if (Route::is('admin.interns.create') || Route::is('user.interns.create'))
    <div class="col-md-6 mb-3">
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
    <div class="col-md-6 mb-3">
        <label for="specialite">Spécialité</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="specialite" class="form-control form-control-sm @error('specialite') is-invalid @enderror" id="specialite" value="{{old('specialite')}}" placeholder="Saisir la specialité">
            @error('specialite')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="type_stage">Type de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="type_stage" class="form-control form-control-sm @error('type_stage') is-invalid @enderror" id="type_stage" value="{{old('type_stage')}}" placeholder="Saisir le typge de stage">
            @error('type_stage')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="situation_stage">Situation de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="situation_stage" class="form-control form-control-sm @error('situation_stage') is-invalid @enderror" id="situation_stage" value="{{old('situation_stage')}}" placeholder="Saisir la situation_stage">
            @error('situation_stage')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
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
    <div class="col-md-6 mb-3">
        <label for="date_validations">Date de validité</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="date" name="date_validations" class="form-control form-control-sm @error('date_validations') is-invalid @enderror" id="date_validations" value="{{old('date_validations')}}" placeholder="Saisir la date de validité">
            @error('date_validations')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="start_date">Date de debut de stage</label>
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
    <div class="col-md-6 mb-3">
        <label for="end_date">Date de fin de stage</label>
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
    <div class="col-md-6 mb-3">
        <label for="reconduction">Réconduction</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="reconduction" class="form-control form-control-sm @error('reconduction') is-invalid @enderror" id="reconduction" value="{{old('reconduction')}}" placeholder="Saisir la réconduction">
            @error('reconduction')
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
    <div class="col-md-6 mb-3">
        <label for="nom">Nom & prénoms</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" id="nom" value="{{$intern->nom}}" placeholder="Saisir le nom et prénoms">
            @error('nom')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="specialite">Spécialité</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="specialite" class="form-control form-control-sm @error('specialite') is-invalid @enderror" id="specialite" value="{{$intern->nom}}" placeholder="Saisir la specialité">
            @error('specialite')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="type_stage">Type de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="type_stage" class="form-control form-control-sm @error('type_stage') is-invalid @enderror" id="type_stage" value="{{$intern->type_stage}}" placeholder="Saisir le typge de stage">
            @error('type_stage')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="situation_stage">Situation de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="situation_stage" class="form-control form-control-sm @error('situation_stage') is-invalid @enderror" id="situation_stage" value="{{$intern->situation_stage}}" placeholder="Saisir la situation_stage">
            @error('situation_stage')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="tel">Contact</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-phone"></i>
                </span>
            </div>
            <input type="text" name="tel" class="form-control form-control-sm @error('tel') is-invalid @enderror" id="tel" value="{{$intern->tel}}" placeholder="Saisir le contact">
            @error('tel')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="date_validations">Date de validité</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="date" id="date" name="date_validations" class="form-control form-control-sm @error('date_validations') is-invalid @enderror" id="date_validations" value="{{$intern->date_validations}}" placeholder="Saisir la date de validité">
            @error('date_validations')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="start_date">Date de debut de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{!empty($intern->start_date) ? \Carbon\Carbon::parse($intern->start_date)->format('Y-m-d') : ''}}" placeholder="Saisir la date d'entrée">
            @error('start_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="end_date">Date de fin de stage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="date" id="date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{!empty($intern->end_date) ? \Carbon\Carbon::parse($intern->end_date)->format('Y-m-d') : ''}}" placeholder="Saisir la date de fin de stage">
            @error('end_date')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="reconduction">Réconduction</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-pen"></i>
                </span>
            </div>
            <input type="text" name="reconduction" class="form-control form-control-sm @error('reconduction') is-invalid @enderror" id="reconduction" value="{{$intern->reconduction}}" placeholder="Saisir la réconduction">
            @error('reconduction')
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