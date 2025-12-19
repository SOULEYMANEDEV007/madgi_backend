<div class="col-md-12 mb-3">
    <label for="heure_depart">Heure de départ <span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="time" id="heure_depart" name="heure_depart" class="form-control form-control-sm @error('heure_depart') is-invalid @enderror">
        @error('heure_depart')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12 mb-3">
    <label for="unregister_observation">Pourquoi n'avez vous pas émarger à votre départ <span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="hidden" name="statut" class="statut form-control">
        <textarea name="unregister_observation" id="unregister_observation" cols="30" rows="5" class="form-control form-control-sm @error('unregister_observation') is-invalid @enderror"></textarea>
        @error('unregister_observation')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>