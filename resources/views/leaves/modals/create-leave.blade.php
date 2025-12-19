<div class="modal fade" id="create-leave-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title">Nombre de congé pour {{$user->nom}}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' => [$guard . 'leaves.create.year']]) !!}

                <input type="hidden" name="user_id" value="{{$user->id}}" class="user_id">

                <div class="modal-body">
                    <label for="year">Année</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-cubes"></i>
                            </span>
                        </div>
                        <input type="number" name="year" id="year" class="form-control form-control-sm" placeholder="Ex: 2024" required>
                        @error('year')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="value">Nombre de congé</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-cubes"></i>
                            </span>
                        </div>
                        <input type="number" name="value" id="value" class="form-control form-control-sm " placeholder="Ex: 10" required>
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