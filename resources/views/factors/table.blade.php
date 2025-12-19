<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('factors.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="factors-table">
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
                    <th class="text-sm">Type</th>
                    <th class="text-sm">Statut</th>
                    <th class="text-sm" colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($factors as $key => $item)
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
                            <span class="text-sm">
                                @if ($item->type == 3) VACATAIRE
                                @elseif($item->type == 2) STAGIAIRE
                                @elseif($item->type == 1) EMPLOYE
                                @elseif($item->type == null) AGENT
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->statut_mad}}</span>
                        </td>

                        <td  style="width: 120px">
                            <div class='btn-group'>
                                @can(App\Models\Permission::FACTOR['READ'])
                                    <a href="{{ getGuardedRoute('factors.show', [$item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::FACTOR['UPDATE'])
                                    <a href="{{ getGuardedRoute('factors.edit', [$item->id]) }}"  class='btn btn-warning btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::FACTOR['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'factors.destroy', $item->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $factors])
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
