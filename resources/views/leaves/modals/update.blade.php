<div class="modal fade" id="update-leaves-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title">Assigner un statut</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['class' => 'leaves-form-action', 'enctype' => 'multipart/form-data']) !!}

                <input name="_method" type="hidden" value="PATCH">

                <div class="modal-body">
                    <label for="status">Statut</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-cubes"></i>
                            </span>
                        </div>
                        <select name="status" id="status" class="custom-select custom-select-sm form-control @error('status') is-invalid @enderror">
                            <option selected disabled>Sélectionnez le statut</option>
                            <option value="SUCCESS">ACCEPTE LE CONGE</option>
                            <option value="ERROR">REFUSE LE CONGE</option>
                        </select>
                        @error('status')
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