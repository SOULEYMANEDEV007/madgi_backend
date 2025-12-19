<div class="container">
    <div class="row justify-content-center">
        <div id="inputField1" class="col-md-6 text-center">
            <label for="dropzone-file" class="dropzone-file text-center">
                <span id="success-message" style="display: none; color: rgb(18, 177, 18);">Fichier chargé !!!</span>
                <svg id="svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mt-4 mb-2 text-sm">
                    <span class="font-semibold">Cliquez pour télécharger</span> <br>
                    <span class="font-semibold">ou glisser-déposer</span>
                </p>
                <small>PDF</small>
                <input id="dropzone-file" type="file" name="file" accept="application/pdf" class="custom-file-input" onchange="previewImage()" />
            </label>
        </div>
        <div class="col-md-6">
            <label for="content">Observation</label>
            <div class="input-group mb-2">
                <textarea name="content" id="" cols="40" rows="6" class="form-control form-control-sm @error('content') is-invalid @enderror content-input-field" id="content" placeholder="Saisir le contenu">{{old('content')}}</textarea>
                @error('content')
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
                    <option value="RECOVER" @if(old('status') == 'RECOVER') selected @endif>DOCUMENT RECUPERER</option>
                    <option value="SUCCESS" @if(old('status') == 'SUCCESS') selected @endif>FAVORABLE</option>
                    <option value="ERROR" @if(old('status') == 'ERROR') selected @endif>DEFAVORABLE</option>
                </select>
                @error('status')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="border-top border-primary my-3" style="width: 100%;"></div>

        <div id="inputField2" class="col-12">
            <div class="form-group">
                <label>Personnes à empiler</label>
                <select class="select2 form-control form-control-sm" multiple="multiple" name="peoples[]" data-placeholder="Séléctionnez les personnes à emplier" style="width: 100%;">
                    @foreach ($users as $item)
                        <option value="{{$item->id}}" @if(is_array(old('peoples')) && in_array($item->id, old('peoples'))) selected @endif>{{$item->nom}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectElement = document.getElementById('status');
        var inputField1 = document.getElementById('inputField1');
        var inputField2 = document.getElementById('inputField2');
        if(selectElement.value == 'SUCCESS') {
            inputField1.style.display = 'block';
            inputField2.style.display = 'block';
        }
        else {
            inputField1.style.display = 'none';
            inputField2.style.display = 'none';
        }

        selectElement.addEventListener('change', function () {
            if (selectElement.value === 'SUCCESS') {
                inputField1.style.display = 'block';
                inputField2.style.display = 'block';
            } else {
                inputField1.style.display = 'none';
                inputField2.style.display = 'none';
            }
        });
    });
</script>