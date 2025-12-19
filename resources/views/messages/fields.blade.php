<label for="phone">Saisir un ou plusieurs numéros whatsapp un <span class="text-danger text-lg">(;)</span> doit être entre chaque numéro <span class="text-danger">*</span></label>
<div class="input-group mb-2">
    <textarea name="phone" id="phone" cols="30" rows="5" class="form-control form-control-sm @error('phone') is-invalid @enderror phone-input-field" id="phone" :value="{{old('phone')}}" placeholder="0102030405; 0506070809; 0708090102" required></textarea>
    @error('phone')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="message">Message à envoyé <span class="text-danger">*</span></label>
<div class="input-group mb-2">
    <textarea name="message" id="message" cols="30" rows="5" class="form-control form-control-sm @error('message') is-invalid @enderror message-input-field" id="message" :value="{{old('message')}}" placeholder="Saisir le contenu" required></textarea>
    @error('message')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<label for="file" class="mt-2">Importer une image (optionnel)</label>
<input type="file" name="file" accept=".png, .jpg, .jpeg" class="form-control @error('file') is-invalid @enderror file-input-field" id="file">
@error('file')
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror
