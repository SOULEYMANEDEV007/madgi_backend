<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('workers.search') }}" method="POST">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="workers-table">
            <thead>
            <tr>
                <th class="text-sm">Photo</th>
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Nom et Prénom(s)</th>
                <th class="text-sm">Site</th>
                <th class="text-sm">Fonction</th>
                <th class="text-sm">Service</th>
                {{-- <th class="text-sm">AGE en {{ date('Y') }}</th> --}}
                {{-- <th class="text-sm">Date d'entrée </th> --}}
                <th class="text-sm">Ancienneté</th>
                <th class="text-sm">Grade</th>
                <th class="text-sm">Statut</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($workers as $key => $item)
                <tr>
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
                                        <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}">
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
                    {{-- <td>
                        <span class="btn btn-outline-danger btn-sm">
                            <?php
                                $now=date('Y-m-d');
                                $date1 = new DateTime($now);
                                $date2 = new DateTime($item->date_naissance );
                                $diff = $date1->diff($date2);
                            ?>
                            {{ $diff->y}}
                        </span>
                    </td> --}}
                    {{-- <td>
                        <span class="text-sm">{{$item->date_entre_mad}}</span>
                    </td> --}}
                    <td>
                        <span class="btn btn-outline-success btn-sm">
                            <?php
                                $now=date('Y-m-d');
                                $dat1 = new DateTime($now);
                                $dat2 = new DateTime($item->date_entre_mad );
                                $dif = $dat1->diff($dat2);
                            ?>
                            {{ $dif->y}}
                        </span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->grad->name ?? ''}}</span>
                    </td>
                    <td>
                        <span class="btn btn-{{$item->statut ? 'success' : 'danger'}} btn-xs">{{$item->statut ? 'Activé' : 'Désactivé'}}</span>
                    </td>

                    <td>
                        <div class="btn-group">
                                @can(App\Models\Permission::WORKER['READ'])
                                    <a href="{{ getGuardedRoute('workers.show', [$item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan
                                @can(App\Models\Permission::WORKER['UPDATE'])
                                    <a href="{{ getGuardedRoute('workers.edit', [$item->id]) }}"
                                    class='btn btn-info btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan
                                @can(App\Models\Permission::WORKER['DISABLE'])
                                    {!! Form::open(['route' => [$guard . 'workers.toogle', $item->id], 'method' => 'put']) !!}
                                        {!! Form::button('<i class="fa fa-' . ($item->statut ? 'lock' : 'unlock') . '"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-sm', 'onclick' => "return confirm($item->statut ? 'Voulez-vous désactivé cet employé ?' : 'Voulez-vous activé cet employé ?')"]) !!}
                                    {!! Form::close() !!}
                                @endcan
                                @can(App\Models\Permission::WORKER['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'workers.destroy', $item->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $workers])
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
