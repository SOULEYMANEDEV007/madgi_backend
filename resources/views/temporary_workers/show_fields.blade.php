<div class="col-12 col-sm-5">
    <img src="{{$temporaryWorker->photo != null ? $temporaryWorker->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Spécialité / Corps de métier</h6>
            <strong>{{$temporaryWorker->specialite}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Type de stage / service</h6>
            <strong>{{$temporaryWorker->situation_stage}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Situation convention</h6>
            <strong>{{$temporaryWorker->situation_convention}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Date de validité</h6>
            <strong>{{$temporaryWorker->date_validations ? \Carbon\Carbon::parse($temporaryWorker->date_validations)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Réconduction</h6>
            <strong>{{$temporaryWorker->reconduction}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Date de début</h6>
            <strong>{{$temporaryWorker->start_date ? \Carbon\Carbon::parse($temporaryWorker->start_date)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Date de fin</h6>
            <strong>{{$temporaryWorker->end_date ? \Carbon\Carbon::parse($temporaryWorker->end_date)->format('d/m/Y') : ''}}</strong>
        </div>
    </div>
</div>