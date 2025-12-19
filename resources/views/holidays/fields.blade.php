<label for="name">Titre</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror name-input-field" id="name" :value="{{old('name')}}" placeholder="Fête d'indépendance">
    @error('name')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="name">Date</label>
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="fa fa-text-height"></i>
        </span>
    </div>
    <input type="hidden" name="id" class="form-control form-control-sm id-input-field">
    <input type="date" id="dateInput" name="date" class="form-control form-control-sm @error('date') is-invalid @enderror date-input-field" id="date" :value="{{old('date')}}">
    @error('date')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>