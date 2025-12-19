<div class="modal fade" id="create-settings-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title">Ajouter un congé annuel</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' => $guard . 'settings.store']) !!}

                <div class="modal-body">
                    <label for="year">Année</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-text-height"></i>
                            </span>
                        </div>
                        <input type="number" name="year" class="form-control form-control-sm @error('year') is-invalid @enderror year-input-field" id="year" placeholder="Ex: 2024">
                        @error('year')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="value" class="id-title"></label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-text-height"></i>
                            </span>
                        </div>
                        <input type="text" name="value" class="form-control form-control-sm @error('value') is-invalid @enderror value-input-field" id="value" placeholder="Ex: 10">
                        @error('value')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Annuler</button>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>