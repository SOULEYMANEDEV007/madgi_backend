<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center id="assessments-table">
            <thead>
                <tr>
                    <th class="text-sm">#</th>
                    <th class="text-sm">Photo</th>
                    <th class="text-sm">Nom et Prénom(s)</th>
                    <th class="text-sm">Matricule</th>
                    <th class="text-sm">Fonction</th>
                    <th class="text-sm">CNPS</th>
                    <th class="text-sm">Grade</th>
                    <th class="text-sm">Situation matrimoniale</th>
                    <th class="text-sm">Statut</th>
                    <th class="text-sm" colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($factors as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" width="30" height="30">
                        </td>
                        <td>
                            <span class="text-sm">{{$item->nom}}</span>
                        </td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$item->matricule}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->fonction}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->cnps}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->grade}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->situation_matrim}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->statut_mad}}</span>
                        </td>

                        <td style="width: 120px">
                            <div class="btn-group">
                                @can(App\Models\Permission::ASSESSMENT['READ'])
                                    <a href="{{ getGuardedRoute('assessments.show', [$item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::ASSESSMENT['READ'])
                                    <a href="{{ getGuardedRoute('assessments.recap', [$item->id]) }}"  class='btn btn-warning btn-sm'>
                                        <i class="fas fa-list"></i>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $factors])
        </div>
    </div>
</div>
