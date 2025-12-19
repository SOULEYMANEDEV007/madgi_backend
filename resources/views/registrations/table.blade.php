<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('registrations.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="registrations-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Photo</th>
                <th class="text-sm">Nom et Prénom(s)</th>
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Date</th>
                <th class="text-sm">Heure d'arrivée</th>
                <th class="text-sm">Heure de départ</th>
                <th class="text-sm">Total du temps</th>
                <th class="text-sm">Statut</th>
                <th class="text-sm">Justificatif arrivé</th>
                <th class="text-sm">Justificatif Départ</th>
                <th class="text-sm">Etat</th>
                <th class="text-sm">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($registrations as $key => $item)
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
                        <span class="text-sm">{{$item->agent->nom ?? $item->nom}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->matricule}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->heure_arrive}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->heure_depart}}</span>
                    </td>
                    <td>
                        <span class="text-sm">
                            @php
                                $arrive = new DateTime($item->heure_arrive);
                                $depart = $item->heure_depart ? new DateTime($item->heure_depart) : '';

                                if ($depart) {
                                    $difference = $arrive->diff($depart);

                                    $days = $difference->days;
                                    $hours = $difference->h;
                                    $minutes = $difference->i;

                                    $formattedDifference = "{$hours} hours, {$minutes} minutes";
                                } else {
                                    $formattedDifference = "";
                                }
                            @endphp
                            @if ($item->statut == '1' && (!request()->has('type') || (request()->has('type') && request()->type == 'present')))
                                {{$formattedDifference}}
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="text-sm btn @if(!empty($item->heure_arrive) && $item->statut == '1') btn-success @elseif($item->statut == '0') btn-danger @endif btn-xs">
                            @if (!empty($item->heure_arrive) && $item->statut == '1') Valider
                            @elseif($item->statut == '0') Invalider
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->justificatif_arrive}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->justificatif_depart}}</span>
                    </td>
                    <td>
                        <span class="text-sm btn @if($item->statut == '1' && !empty($item->heure_arrive) && $parametre->value > $item->heure_arrive) btn-success @elseif($item->statut == '0') btn-danger @endif btn-xs">
                            @if ($item->statut == '1' && !empty($item->heure_arrive) && $parametre->value > $item->heure_arrive) A l'heure
                            @elseif($item->statut == '0') En retard
                            @endif
                        </span>
                    </td>
                    <td x-data="{
                        read($item) {
                            $('.modal-title').text('Commentaire de l\'utilisateur {{$item->agent->nom ?? $item->nom}} pour l\'émargement du {{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}}')
                            $('#read-registrations-modal').modal('show');
                            $('.unregister_observation').text($item.unregister_observation);
                        },
                        show($item, $route) {
                            $('#update-registrations-modal').modal('show');
                            $('.registrations-form-action').attr('action', $route);
                            $('.statut-input-field').val($item.statut);
                        },
                        comment($item, $route) {
                            $('#comment-registrations-modal').modal('show');
                            $('.registrations-form-action').attr('action', $route);
                            $('.statut').val($item.statut);
                            $('#unregister_observation').val($item.unregister_observation);
                        },
                    }">
                        @if (auth()->guard(\App\Models\Admin::$guard)->check())
                            @can(App\Models\Permission::REGISTER['UPDATE'])
                                @if (!empty($item->unregister_observation))
                                    <a x-on:click="read({{$item}})" href="javascript:;" class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endif

                                @if (!empty($item->photo) || (!empty($item->unregister_observation)) || $item->type_device == 'web')
                                    <a x-on:click="show({{$item}}, '{{getGuardedRoute('registrations.update', $item->id)}}')" href="javascript:;" class='btn btn-warning btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endif
                            @endcan
                        @else
                            @php
                                $dateToCheck = \Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->startOfDay();
                                $currentDate = \Carbon\Carbon::now()->startOfDay();
                                if ($dateToCheck < $currentDate) $isPassed = true;
                                else $isPassed = false;

                            @endphp
                            @if (empty($item->heure_depart) && $isPassed && empty($item->unregister_observation))
                                <a x-on:click="comment({{$item}}, '{{getGuardedRoute('registrations.update', $item->id)}}')" href="javascript:;" class='btn btn-warning btn-sm'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $registrations])
        </div>
    </div>
</div>

@include('registrations.modals.read')
@include('registrations.modals.update')
@include('registrations.modals.comment')

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
