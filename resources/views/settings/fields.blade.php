<input type="hidden" name="id" class="form-control form-control-sm id-input-field">

<div class="year-field d-none">
    <label for="year">Année</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="fa fa-text-height"></i>
            </span>
        </div>
        <input type="number" name="year" class="form-control form-control-sm @error('year') is-invalid @enderror year-input-field" id="year" :value="{{old('year')}}" placeholder="Ex: 2024">
        @error('year')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<label for="value" class="id-title"></label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="text" name="value" class="form-control form-control-sm @error('value') is-invalid @enderror value-input-field" id="value" :value="{{old('value')}}">
    @error('value')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>