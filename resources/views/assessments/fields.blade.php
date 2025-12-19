<div class="col-12 col-sm-4">
    <img src="{{$factor->photo != null ? $factor->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
    <div class="p-2 mb-3" style="border: 2px solid #FF9F47 !important; border-radius: 15px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.125), 2px 2px 2px rgba(0, 0, 0, 0.2)">
        <h3 class="text-center">Récapitulatif:</h3>
        <p><strong>Nom & Prénoms</strong>: {{$factor->nom}}</p>
        <p><strong>Fonction</strong>: {{$factor->fonction}}</p>
        <p><strong>Matricule</strong>: {{$factor->matricule}}</p>
        <p><strong>Département</strong>: {{$factor->depart->name ?? ''}}</p>
        <p><strong>Service</strong>: {{$factor->serv->name ?? ''}}</p>
    </div>
</div>
<div class="col-12 col-sm-8">
    @livewire('automate', ['formAssessments' => $formAssessments, 'factor' => $factor])
</div>