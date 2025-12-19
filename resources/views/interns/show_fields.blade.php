<div class="col-12 col-sm-5">
    <img src="{{$intern->photo != null ? $intern->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Téléphone</h6>
            <strong>{{$intern->tel}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Spécialité</h6>
            <strong>{{$intern->specialite}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Type de stage</h6>
            <strong>{{$intern->situation_stage}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Situation de stage</h6>
            <strong>{{$intern->situation_stage}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Date de validité</h6>
            <strong>{{$intern->date_validations ? \Carbon\Carbon::parse($intern->date_validations)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Réconduction</h6>
            <strong>{{$intern->reconduction}}</strong>
        </div>
    </div>
    
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Date de début de stage</h6>
            <strong>{{$intern->start_date ? \Carbon\Carbon::parse($intern->start_date)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Date de fin de stage</h6>
            <strong>{{$intern->end_date ? \Carbon\Carbon::parse($intern->end_date)->format('d/m/Y') : ''}}</strong>
        </div>
    </div>
</div>