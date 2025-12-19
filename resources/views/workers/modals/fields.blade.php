<label for="name">Nom du document</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror name-input-field" id="name" :value="{{old('name')}}" placeholder="Saisir le nom du document" required>
    @error('name')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="date">Date</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="date" name="date" class="form-control form-control-sm @error('date') is-invalid @enderror date-input-field" id="date" :value="{{old('date')}}" placeholder="Saisir le nom du document">
    @error('date')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="file" class="mt-2">Fichier de l'information</label>
<input type="file" name="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('file') is-invalid @enderror file-input-field" id="file">
@error('file')
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror