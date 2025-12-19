<div class="modal fade" id="create-admin-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title">Ajouter un admin</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' => $guard . 'admins.store']) !!}

                <div class="modal-body">
                    @include('admins.fields')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Annuler</button>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>