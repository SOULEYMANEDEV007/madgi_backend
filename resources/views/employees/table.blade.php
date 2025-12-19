<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('employees.search') }}" method="POST">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="employees-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Photo</th>
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Nom et Prénom(s)</th>
                <th class="text-sm">Site</th>
                <th class="text-sm">Fonction</th>
                <th class="text-sm">Service</th>
                <th class="text-sm">Grade</th>
                <th class="text-sm">Genre</th>
                <th class="text-sm">Statut</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" width="30" height="30" data-toggle="modal" data-target="#model-{{ $key }}">

                        <div class="modal fade" id="model-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $key }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" width="200" height="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="btn btn-light btn-sm">{{$item->matricule}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->nom}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->Sit->name ?? ''}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->fonction}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->serv->name ?? ''}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->grad->name ?? ''}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->genre}}</span>
                    </td>
                    <td>
                        <span class="btn btn-{{$item->statut ? 'success' : 'danger'}} btn-xs">{{$item->statut ? 'Activé' : 'Désactivé'}}</span>
                    </td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            @can(App\Models\Permission::EMPLOYEE['READ'])
                                <a href="{{ getGuardedRoute('employees.show', [$item->id]) }}"
                                class='btn btn-primary btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan

                            @can(App\Models\Permission::EMPLOYEE['UPDATE'])
                                <a href="{{ getGuardedRoute('employees.edit', [$item->id]) }}"  class='btn btn-info btn-sm'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan

                            @can(App\Models\Permission::EMPLOYEE['DISABLE'])
                                {!! Form::open(['route' => [$guard . 'employees.toogle', $item->id], 'method' => 'put']) !!}
                                    {!! Form::button('<i class="fa fa-' . ($item->statut ? 'lock' : 'unlock') . '"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-sm', 'onclick' => "return confirm($item->statut ? 'Voulez-vous désactivé ce salarié ?' : 'Voulez-vous activé ce salarié ?')"]) !!}
                                {!! Form::close() !!}
                            @endcan

                            @can(App\Models\Permission::EMPLOYEE['DELETE'])
                                {!! Form::open(['route' => [$guard . 'employees.destroy', $item->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $employees])
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
