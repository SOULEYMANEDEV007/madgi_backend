<div class="col-12 col-sm-5">
    <img src="{{$worker->photo != null ? $worker->photo : asset('/images/user.png')}}" class="product-image" alt="Product Image">

    @if (!empty($worker->files))
        <div class="table-responsive mt-3">
            <h5>Documents</h5>
            <table class="table table-bordered table-striped text-center" id="worker-table">
                <thead>
                <tr>
                    <th class="text-sm">Nom</th>
                    <th class="text-sm">Date</th>
                    <th class="text-sm">Document</th>
                    <th class="text-sm">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($worker->files as $item)
                        <tr>
                            <td>
                                <span class="text-sm">{{$item->name}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</span>
                            </td>
                            <td>
                                @if (!empty($item->doc))
                                    @if (pathinfo($item->doc->src, PATHINFO_EXTENSION) == 'pdf')
                                        <a href="{{$item->doc->src}}" target="_blank">
                                            <i class="fa fa-file text-primary text-center"></i>
                                        </a>
                                    @else
                                        <img src="{{!empty($item->doc) ? $item->doc->src : asset('/images/user.png')}}" class="product-file" alt="Product File" width="30" height="30" data-toggle="modal" data-target="#model-{{ $item->name }}">

                                        <div class="modal fade" id="model-{{ $item->name }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $item->name }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{!empty($item->doc) ? $item->doc->src : asset('/images/user.png')}}" width="200" height="200">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else <i class="fa fa-ban" style="color: red;"></i>
                                @endif
                            </td>
                            <td  style="width: 120px">
                                {!! Form::open(['route' => [$guard . 'workers.delete.file', $item->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Matricule</h6>
            <strong>{{$worker->matricule}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">CNPS</h6>
            <strong>{{$worker->cnps}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Téléphone</h6>
            <strong>{{$worker->tel}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Situation .m</h6>
            <strong>{{$worker->situation_matrim}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Genre</h6>
            <strong>{{$worker->genre}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Grade</h6>
            <strong>{{$worker->grad->name ?? ''}}</strong>
        </div>
    </div>

    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Date de naissance</h6>
            <strong>{{$worker->date_naissance ? \Carbon\Carbon::parse($worker->date_naissance)->format('d/m/Y') : ''}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Diplôme</h6>
            <strong>{{$worker->diplome}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Email</h6>
            <strong>{{$worker->email}}</strong>
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
                    <span class="text-sm">{{$worker->Sit->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->nombre_enfant}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->serv->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->confession_relg}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->specialite}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->depart->name ?? ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->situation_stage}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->situation_convention}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->reconduction}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->date_occupation_p ? \Carbon\Carbon::parse($worker->date_occupation_p)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->date_validations ? \Carbon\Carbon::parse($worker->date_validations)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->date_entre_mad ? \Carbon\Carbon::parse($worker->date_entre_mad)->format('d/m/Y') : ''}}</span>
                </td>
                <td>
                    <span class="text-sm">{{$worker->fonction}}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>