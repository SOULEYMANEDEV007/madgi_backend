<div class="col-12 col-sm-5">
    <img src="{{$employee->photo != null ? $employee->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">
</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Matricule</h6>
            <strong>{{$employee->matricule}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">CNPS</h6>
            <strong>{{$employee->cnps}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Téléphone</h6>
            <strong>{{$employee->tel}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Situation .m</h6>
            <strong>{{$employee->situation_matrim}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Genre</h6>
            <strong>{{$employee->genre}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Grade</h6>
            <strong>{{$employee->grad->name ?? ''}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Date de naissance</h6>
            <strong>{{$employee->date_naissance ? \Carbon\Carbon::parse($employee->date_naissance)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Diplôme</h6>
            <strong>{{$employee->diplome}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Email</h6>
            <strong>{{$employee->email}}</strong>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped text-center" id="worker-table">
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
                    <span class="text-sm">{{$employee->Sit->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->nombre_enfant}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->serv->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->confession_relg}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->specialite}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->depart->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->situation_stage}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->situation_convention}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->reconduction}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->date_occupation_p ? \Carbon\Carbon::parse($employee->date_occupation_p)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->date_validations ? \Carbon\Carbon::parse($employee->date_validations)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->date_entre_mad ? \Carbon\Carbon::parse($employee->date_entre_mad)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$employee->fonction}}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>