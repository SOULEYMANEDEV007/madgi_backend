<div class="col-12 col-sm-5">
    <img src="{{$factor->photo != null ? $factor->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Matricule</h6>
            <strong>{{$factor->matricule}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">CNPS</h6>
            <strong>{{$factor->cnps}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Téléphone</h6>
            <strong>{{$factor->tel}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Situation .m</h6>
            <strong>{{$factor->situation_matrim}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Genre</h6>
            <strong>{{$factor->genre}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Grade</h6>
            <strong>{{$factor->grad->name ?? ''}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Date de naissance</h6>
            <strong>{{$factor->date_naissance}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Diplôme</h6>
            <strong>{{$factor->diplome}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Email</h6>
            <strong>{{$factor->email}}</strong>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped text-center" id="factor-table">
        <thead>
        <tr>
            <th class="text-sm">Site</th>
            <th class="text-sm">Enfants</th>
            <th class="text-sm">Service</th>
            <th class="text-sm">Réligion</th>
            <th class="text-sm">Specialité</th>
            <th class="text-sm">Département</th>
            <th class="text-sm">Stage</th>
            <th class="text-sm">Convention</th>
            <th class="text-sm">Réconduction</th>
            <th class="text-sm">Occupation</th>
            <th class="text-sm">Validation</th>
            <th class="text-sm">Entrée</th>
            <th class="text-sm">Fonction</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span class="text-sm">{{$factor->Sit->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->nombre_enfant}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->serv->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->confession_relg}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->specialite}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->depart->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->situation_stage}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->situation_convention}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->reconduction}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->date_occupation_p}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->date_validations}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->date_entre_mad}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$factor->date_fonction}}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>