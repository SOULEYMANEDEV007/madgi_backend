<div class="col-12 col-sm-6">
    <img src="{{$leave->medias->count() > 0 ? $leave->medias->first->src : asset('/images/user.png')}}" class="product-image" alt="Product Image">
    <h5>
        <u>Motif</u>
    </h5>
    <p>{{$leave->motif}}</p>
</div>
<div class="col-12 col-sm-6 text-center">
    <div class="row my-3">
        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Matricule</h6>
            <strong>{{$leave->matricule}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Début</h6>
            <strong>{{$leave->start_date}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Fin</h6>
            <strong>{{$leave->end_date}}</strong>
        </div>
    </div>

    <div class="row my-3">
        <div class="col p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Lieu</h6>
            <strong>{{$leave->place_enjoyment}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">Personne à contacter</h6>
            <strong>{{$leave->call_user_name}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #6c757d; border-radius: 10px;">
            <h6 class="mb-2 bg-secondary p-1 text-bold">N° d'urgence</h6>
            <strong>
                <a href="tel:{{$leave->call_phone}}">
                    <i class="fas fa-phone"></i>
                    {{$leave->call_phone}}
                </a>
            </strong>
        </div>
    </div>

    <div class="row my-3">
        <div class="col p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Département</h6>
            <strong>{{$leave->department->name ?? ''}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Service</h6>
            <strong>{{$leave->service->name ?? ''}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Type de congé</h6>
            <strong>{{$leave->type->name ?? ''}}</strong>
        </div>
    </div>

    <div class="row my-3">
        <div class="col p-3 mx-3" style="border: 2px dashed green; border-radius: 10px;">
            <h6 class="mb-2 bg-green p-1 text-bold">Date de reprise</h6>
            <strong>{{$leave->resumption}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed green; border-radius: 10px;">
            <h6 class="mb-2 bg-green p-1 text-bold">Nb(jours) d'absence</h6>
            <strong>{{$leave->number_absence}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed green; border-radius: 10px;">
            <h6 class="mb-2 bg-green p-1 text-bold">Intérime</h6>
            <strong>{{$leave->interim}}</strong>
        </div>
    </div>

    <div class="row justify-content-center align-items-center text-center">
        <div class="col bg-{{$leave->status == "PENDING" ? 'warning' : ($leave->status == "SUCCESS" ? 'success' : 'danger')}}">
            <p class="pt-3"><u>Statut</u>: {{$leave->status == 'PENDING' ? 'En attente' : ($leave->status == 'SUCCESS' ? 'Accepté' : 'Réfusé')}}</p>
        </div>
    </div>

    <div class="p-3 mx-3 mt-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
        <h6 class="mb-2 bg-info p-1 text-bold text-center">Etapes d'avancements</h6>
        <ul>
            @include('leaves.step')
        </ul>
    </div>

</div>