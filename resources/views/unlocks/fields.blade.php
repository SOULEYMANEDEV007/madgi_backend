<label for="unlocks">Action</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="fa fa-text-height"></i>
            </span>
        </div>
        <select name="unlocks" id="unlocks" class="custom-select custom-select-sm form-control @error('unlocks') is-invalid @enderror unlocks-input-field">
            <option selected disabled>Sélectionnez l'action</option>
            <option value="BLOQUE">BLOQUE</option>
            <option value="DEBLOQUE">DEBLOQUE</option>
        </select>
        @error('unlocks')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>