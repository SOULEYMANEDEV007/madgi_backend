@if(auth()->guard(\App\Models\Admin::$guard)->check() && !Route::is('admin.leaves.appreciation'))
    @livewire('leave')
@else
    <input type="hidden" name="path" class="form-control form-control-sm" value="{{request()->type}}" type="text" placeholder="{{request()->type}}" readonly>
    @if (Route::is('admin.leaves.create') || Route::is('user.leaves.create'))
        <div class="col-md-4 mb-3">
            <label for="type_id">Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-cubes"></i>
                    </span>
                </div>
                @php
                    $req = request()->type == 'annuel' ? 1 : 2;
                    $type = \App\Models\TypeLeave::find($req);
                @endphp
                <input type="hidden" name="type_id" class="form-control form-control-sm @error('type_id') is-invalid @enderror" id="type_id" value="{{$type->id}}" type="text" placeholder="{{$type->id}}" readonly>
                <input type="text" name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" id="type" value="{{$type->name}}" type="text" placeholder="{{$type->name}}" readonly>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="fullname">Nom & prénoms</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="text" name="fullname" class="form-control form-control-sm @error('fullname') is-invalid @enderror" id="fullname" value="{{auth()->user()->nom}}" placeholder="Saisir le nom et prénoms" disabled>
                @error('fullname')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="matricule">Matricule</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="text" name="matricule" class="form-control form-control-sm @error('matricule') is-invalid @enderror" id="matricule" value="{{auth()->user()->matricule}}" placeholder="Saisir le matricule" disabled>
                @error('matricule')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
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
                <input class="form-control form-control-sm" name="department" value="{{auth()->user()->depart->name}}" type="text" placeholder="{{auth()->user()->depart->name}}" readonly>
                <input class="form-control form-control-sm" name="department_id" value="{{auth()->user()->departement}}" type="hidden" placeholder="{{auth()->user()->departement}}" readonly>
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
                <input class="form-control form-control-sm" name="service" value="{{auth()->user()->serv->name}}" type="text" placeholder="{{auth()->user()->serv->name}}" readonly>
                <input class="form-control form-control-sm" name="service_id" value="{{auth()->user()->service}}" type="hidden" placeholder="{{auth()->user()->service}}" readonly>
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
                <input type="date" id="dateInput" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" value="{{old('start_date')}}" placeholder="Saisir la date d'entrée">
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
                <input type="date" id="dateInput" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" value="{{old('end_date')}}" placeholder="Saisir la date d'entrée">
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
                <input type="date" id="dateInput" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" id="resumption" value="{{old('resumption')}}" placeholder="Saisir la date de reprise">
                @error('resumption')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div id="number_absence" class="col-md-4 mb-3">
            <label for="number_absence">Nombre de jours d'absence</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="number" id="number_absence" name="number_absence" class="form-control form-control-sm @error('number_absence') is-invalid @enderror" id="number_absence" value="{{old('number_absence')}}" placeholder="Saisir le nombre de jours d'absence" min="1">
                @error('number_absence')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="place_enjoyment">Lieu de jouissance</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fa fa-pen"></i>
                    </span>
                </div>
                <input type="text" name="place_enjoyment" class="form-control form-control-sm @error('place_enjoyment') is-invalid @enderror" id="place_enjoyment" value="{{old('place_enjoyment')}}" placeholder="Saisir le lieu">
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
                <input type="text" name="call_user_name" class="form-control form-control-sm @error('call_user_name') is-invalid @enderror" id="call_user_name" value="{{old('call_user_name')}}" placeholder="Saisir la personne à contacter">
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
                <input type="text" name="call_phone" class="form-control form-control-sm @error('call_phone') is-invalid @enderror" id="call_phone" value="{{old('call_phone')}}" placeholder="Saisir le téléphone">
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
                <input type="text" name="interim" class="form-control form-control-sm @error('interim') is-invalid @enderror" id="interim" value="{{old('interim')}}" placeholder="Saisir l'intérime">
                @error('interim')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <label for="motif">Motif</label>
            <div class="input-group">
                <textarea name="motif" id="" cols="40" rows="6" class="form-control form-control-sm @error('motif') is-invalid @enderror motif-input-field" id="motif" placeholder="Saisir le contenu">{{old('motif')}}</textarea>
                @error('motif')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @else
        <div class="container">
            @if (isset($result) && $result->role->id != 5 || $leave->w_admin == 1)
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <label for="dropzone-file">Chargez l'image de la signature</label>
                        <div x-data="{nb: 1}">
                            <label for="dropzone-file" class="dropzone-file @error('picture') is-invalid @enderror">
                                <img src="" class="image-preview" :id="`agentImagePreview${nb}`">
                                <i id="agentFileIcon1" class="fas fa-file-pdf" style="font-size: 48px; color: red; display: none;"></i>
                                <svg :id="`agentSvg${nb}`" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 50px; height: 50px;">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mt-4 mb-2 text-sm">
                                    <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                    <span class="font-semibold">ou glisser-déposer</span>
                                </p>
                                <small>PNG, JPG, JPEG ou PDF (MAX. 100MB)</small>
                                <input id="dropzone-file" type="file" name="picture" class="custom-file-input" accept="image/png, image/jpeg, image/jpg, application/pdf" x-on:change="previewAgentImage($event, 1)" :data-index="`${nb}`" />
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-left: 75px;">
                        <label for="content">Observation</label>
                        <div class="input-group mb-2">
                            <textarea name="content" id="" cols="40" rows="6" class="form-control form-control-sm @error('content') is-invalid @enderror content-input-field" id="content" placeholder="Saisir le contenu">{{old('content')}}</textarea>
                            @error('content')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="new_start_date">Date de début</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" id="dateInput" name="new_start_date" class="form-control form-control-sm @error('new_start_date') is-invalid @enderror" value="{{$leave->start_date}}">
                                    @error('new_start_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="new_end_date">Date de fin</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" id="dateInput" name="new_end_date" class="form-control form-control-sm @error('new_end_date') is-invalid @enderror" value="{{$leave->end_date}}">
                                    @error('new_end_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="resumption" class="col-md-6 mb-3">
                        <label for="resumption">Date de reprise</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fa fa-pen"></i>
                                </span>
                            </div>
                            <input type="date" id="dateInput" name="resumption" class="form-control form-control-sm @error('resumption') is-invalid @enderror" value="{{$leave->resumption}}">
                            @error('resumption')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status">Statut</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-cubes"></i>
                                </span>
                            </div>
                            <select name="status" id="status" class="custom-select custom-select-sm form-control @error('status') is-invalid @enderror">
                                <option selected disabled>Sélectionnez le statut</option>
                                <option value="SUCCESS">FAVORABLE</option>
                                <option value="ERROR">DEFAVORABLE</option>
                            </select>
                            @error('status')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <label for="content">Observation</label>
                        <div class="input-group mb-2">
                            <textarea name="content" rows="6" class="form-control form-control-sm @error('content') is-invalid @enderror content-input-field" id="content" placeholder="Saisir le contenu">{{old('content')}}</textarea>
                            @error('content')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="new_start_date">Date de début</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" id="dateInput" name="new_start_date" class="form-control form-control-sm @error('new_start_date') is-invalid @enderror" value="{{$leave->start_date}}">
                                    @error('new_start_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="new_end_date">Date de fin</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" id="dateInput" name="new_end_date" class="form-control form-control-sm @error('new_end_date') is-invalid @enderror" value="{{$leave->end_date}}">
                                    @error('new_end_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <label for="status">Statut</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-cubes"></i>
                                </span>
                            </div>
                            <select name="status" id="status" class="custom-select custom-select-sm form-control form-control-sm @error('status') is-invalid @enderror">
                                <option selected disabled>Sélectionnez le statut</option>
                                <option value="SUCCESS">FAVORABLE</option>
                                <option value="ERROR">DEFAVORABLE</option>
                            </select>
                            @error('status')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="border-top border-primary my-3" style="width: 100%;"></div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Personnes à empiler</label>
                            <select class="select2 form-control form-control-sm" multiple="multiple" name="peoples[]" data-placeholder="Séléctionnez les personnes à emplier" style="width: 100%;">
                                @foreach ($users as $item)
                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endif
