<div class="col-12 col-sm-6">
    <img src="{{$certificate->user->photo != null ? $certificate->user->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
</div>
<div class="col-12 col-sm-6 text-center">
    <div class="row my-5">
        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Matricule</h6>
            <strong>{{$certificate->matricule}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Date de demande</h6>
            <strong>{{\Carbon\Carbon::parse($certificate->created_at)->format('d/m/Y')}}</strong>
        </div>

        <div class="col p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Date de traitement</h6>
            @if ($certificate->status != 'PENDING')
                <strong>{{\Carbon\Carbon::parse($certificate->updated_at)->format('d/m/Y')}}</strong>
            @else <strong>N/A</strong>
            @endif
        </div>
    </div>

    <div class="row @if($certificate->department || $certificate->site) my-5 @endif">
        @if ($certificate->department)
            <div class="col p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
                <h6 class="mb-2 bg-red p-1 text-bold">Département</h6>
                <strong>{{$certificate->department?->name}}</strong>
            </div>
        @endif

        @if ($certificate->site)
            <div class="col p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
                <h6 class="mb-2 bg-red p-1 text-bold">Site</h6>
                <strong>{{$certificate->site?->name}}</strong>
            </div>
        @endif
    </div>

    <div class="row @if($certificate->duration || $certificate->start_date || $certificate->end_date) my-5 @endif">
        @if ($certificate->duration)
            <div class="col p-3 mx-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
                <h6 class="mb-2 bg-info p-1 text-bold">Durée</h6>
                <strong>{{$certificate->duration}}</strong>
            </div>
        @endif

        @if ($certificate->start_date)
            <div class="col p-3 mx-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
                <h6 class="mb-2 bg-info p-1 text-bold">
                    @if ($certificate->type == "Attestation de reprise de service maternité") Date de reprise
                    @else Date de début
                    @endif
                </h6>
                <strong>{{\Carbon\Carbon::parse($certificate->start_date)->format('d/m/Y')}}</strong>
            </div>
        @endif

        @if ($certificate->end_date)
            <div class="col p-3 mx-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
                <h6 class="mb-2 bg-info p-1 text-bold">Date de fin</h6>
                <strong>{{\Carbon\Carbon::parse($certificate->end_date)->format('d/m/Y')}}</strong>
            </div>
        @endif
    </div>

    <div class="row @if($certificate->resumption || $certificate->work_date) my-5 @endif">
        @if ($certificate->resumption)
            <div class="col p-3 mx-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
                <h6 class="mb-2 bg-info p-1 text-bold">Reprise de service</h6>
                <strong>{{\Carbon\Carbon::parse($certificate->resumption)->format('d/m/Y')}}</strong>
            </div>
        @endif

        @if ($certificate->work_date)
            <div class="col p-3 mx-3" style="border: 2px dashed #17a2b8; border-radius: 10px;">
                <h6 class="mb-2 bg-info p-1 text-bold">Date d'admission au département</h6>
                <strong>{{\Carbon\Carbon::parse($certificate->work_date)->format('d/m/Y')}}</strong>
            </div>
        @endif
    </div>

    <div class="row @if($certificate->motif) my-5 @endif">
        @if ($certificate->motif)
            <div class="col p-3 mx-3" style="border: 2px dashed gray; border-radius: 10px;">
                <h6 class="mb-2 bg-secondary p-1 text-bold">Motif</h6>
                <p>{{$certificate->motif}}</p>
            </div>
        @endif
    </div>

    <div class="row @if($certificate->content) my-5 @endif">
        @if ($certificate->content)
            <div class="col p-3 mx-3" style="border: 2px dashed gray; border-radius: 10px;">
                <h6 class="mb-2 bg-secondary p-1 text-bold">Commentaire</h6>
                <p>{{$certificate->content}}</p>
            </div>
        @endif
    </div>

    <div class="row justify-content-center align-items-center text-center">
        <div class="col bg-info mx-2">
            @if ($certificate->status == "SUCCESS" && !empty($certificate->media))
                <a href="{{$certificate->media->src}}" download="" class='btn btn-info btn-sm py-3'>
                    <i class="fas fa-file"></i> Télécharger le document
                </a>
            @endif
        </div>
        @if ($certificate->status == "SUCCESS")
            <div class="col bg-success">
                <p class="pt-3"><strong>Statut: </strong> Accepté</p>
            </div>
        @elseif ($certificate->status == "PENDING")
            <div class="col bg-warning">
                <p class="pt-3"><strong>Statut: </strong> En cours</p>
            </div>
        @elseif ($certificate->status == "RECOVER")
            <div class="col bg-info">
                <p class="pt-3"><strong>Statut: </strong> Document récupéré</p>
            </div>
        @else
            <div class="col bg-danger">
                <p class="pt-3"><strong>Statut: </strong> Réfusé</p>
            </div>
        @endif
    </div>
</div>
