@if (Route::is('admin.registrations.create') || Route::is('user.registrations.create'))
    {{-- <div class="col-md-4">
        <video id="preview" style="display:none; width: 250px; heigth: 250px;"></video>
        <canvas id="qr-canvas" style="width: 250px; heigth: 250px;"></canvas>
        <div id="result"></div>
        <input type="hidden" name="date" class="date">
        <input type="hidden" name="time" class="time">
        <input type="hidden" name="type_device" class="type_device">
        <input type="hidden" name="matricule" class="matricule">
    </div> --}}

    <div class="col-md-3 my-1">
        <label for="date">Date</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-calendar"></i>
                </span>
            </div>
            <input type="text" name="date" class="form-control form-control-sm @error('date') is-invalid @enderror" id="registerDate" readonly>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <label for="time">Heure</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-clock"></i>
                </span>
            </div>
            <input type="text" name="time" class="form-control form-control-sm @error('time') is-invalid @enderror" id="registerTime" readonly>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <label for="matricule">Matricule</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-signature"></i>
                </span>
            </div>
            <input type="text" name="matricule" class="form-control form-control-sm @error('matricule') is-invalid @enderror" id="matricule" value="{{auth()->user()->matricule}}" readonly>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <label for="type_device">Périphérique</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-desktop"></i>
                </span>
            </div>
            <input type="text" name="type_device" class="form-control form-control-sm @error('type_device') is-invalid @enderror" id="type_device" value="web" readonly>
            @error('type_device')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3 d-none my-1">
        <label for="unique_web_identifier">Unique identifier</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-desktop"></i>
                </span>
            </div>
            <input type="text" name="unique_web_identifier" class="form-control form-control-sm @error('unique_web_identifier') is-invalid @enderror" id="unique_web_identifier" value="{{auth()->user()->unique_web_identifier ?? $cookie}}" readonly>
            @error('unique_web_identifier')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @if (\Carbon\Carbon::now()->greaterThan($setting))
        <div class="col-md-12 mt-1">
            <label for="observation">Observation</label>
            <div class="input-group mb-2">
                <textarea name="observation" id="" cols="30" rows="5" class="form-control form-control-sm @error('observation') is-invalid @enderror content-input-field" id="observation" :value="{{old('observation')}}" placeholder="Saisir le contenu"></textarea>
                @error('observation')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endif
@else
    <label for="statut">Statut</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="fa fa-text-height"></i>
            </span>
        </div>
        <select name="statut" id="statut" class="custom-select custom-select-sm form-control @error('statut') is-invalid @enderror statut-input-field">
            <option selected disabled value="">Sélectionnez le statut</option>
            <option value="1">Valider</option>
            <option value="0">Pas valider</option>
        </select>
        @error('statut')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div id="observation" class="col-md-12 mb-3">
        <label for="observation">Observation <span class="text-danger">*</span></label>
        <div class="input-group">
            <textarea name="observation" id="observation" cols="30" rows="5" class="form-control form-control-sm @error('observation') is-invalid @enderror"></textarea>
            @error('observation')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectElement = document.getElementById('statut');
        var inputField = document.getElementById('observation');
            inputField.style.display = 'none';

        selectElement.addEventListener('change', function () {
            if (selectElement.value === '0') {
                inputField.style.display = 'block';
            } else {
                inputField.style.display = 'none';
            }
        });
    });
</script>