<div class="modal fade" id="update-departements-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title">Modifier un département</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['class' => 'departements-form-action', 'enctype' => 'multipart/form-data']) !!}

                <input name="_method" type="hidden" value="PATCH">

                <div class="modal-body">
                    @include('departements.fields')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Annuler</button>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>