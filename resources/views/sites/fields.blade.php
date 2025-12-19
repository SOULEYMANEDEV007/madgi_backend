<label for="name">Site</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror name-input-field" id="name" :value="{{old('name')}}" placeholder="Saisir le site">
    @error('name')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>