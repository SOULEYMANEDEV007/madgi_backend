<label for="post_name">Emetteur</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="text" name="post_name" class="form-control form-control-sm @error('post_name') is-invalid @enderror post_name-input-field" id="post_name" :value="{{old('post_name')}}" placeholder="Saisir l'emetteur" required>
    @error('post_name')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

{{-- <label for="post_phone">Téléphone</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="number" name="post_phone" class="form-control form-control-sm @error('post_phone') is-invalid @enderror post_phone-input-field" id="post_phone" :value="{{old('post_phone')}}" placeholder="Saisir le contact">
    @error('post_phone')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div> --}}

@if (auth()->guard(\App\Models\Admin::$guard)->check() && auth()->guard(\App\Models\Admin::$guard)->user()->role->id == 1)
    <label for="post_phone">Destinataire</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="fa fa-text-height"></i>
            </span>
        </div>
        <select name="department_id" id="departement" class="custom-select custom-select-sm form-control @error('department_id') is-invalid @enderror departement-input-field" required>
            <option selected disabled>Sélectionnez le département</option>
            <option value="0">Tous les départements</option>
            @foreach ($departments as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('departement')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
@endif

<label for="content">Description</label>
<div class="input-group mb-2">
    <textarea name="content" id="" cols="30" rows="5" class="form-control form-control-sm @error('content') is-invalid @enderror content-input-field" id="content" :value="{{old('content')}}" placeholder="Saisir le contenu" required></textarea>
    @error('content')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="file" class="mt-2">Fichier de l'information</label>
<input type="file" name="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('file') is-invalid @enderror file-input-field" id="file">
@error('file')
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror
