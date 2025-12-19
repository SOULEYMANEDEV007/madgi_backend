<div>
    <div class="form-group">
        <label for="status" class="{{$assessment[0]->status ? 'bg-warning px-2' : ''}}">Statut {{$assessment[0]->status ? 'actuel ' . $assessment[0]->status : ''}}</label>
        <select wire:model.live="selectedOption" id="status" class="form-control form-control-sm" name="status" style="border: 2px solid #FF9F47 !important; border-radius: 10px;">
            <option selected disabled value="">Sélectionnez le statut</option>
            <option value="en attente">En attente</option>
            <option value="traiter">Traiter</option>
            <option value="refuser">Refuser</option>
        </select>
    </div>
</div>
