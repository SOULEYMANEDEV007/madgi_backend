<div class="card-body">
    {{-- <form id="paginationForm" action="{{ getGuardedRoute('leaves.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form> --}}
    <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="leaves-table">
            <thead>
            <tr>
                {{-- <th class="text-sm">#</th> --}}
                <th class="text-sm">Photo</th>
                @if (auth()->guard(App\Models\Admin::$guard)->check())
                    <th class="text-sm">Nom et Prénom(s)</th>
                @endif
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Début</th>
                <th class="text-sm">Fin</th>
                {{-- <th class="text-sm">Lieu</th>
                <th class="text-sm">Personne à contacter</th> --}}
                <th class="text-sm">N° d'urgence</th>
                @if (auth()->guard(App\Models\Admin::$guard)->check())
                    <th class="text-sm">Mon statut</th>
                @endif
                <th class="text-sm">Décision finale</th>
                <th class="text-sm">Document</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leaves as $key => $item)
                <tr>
                    {{-- <td>{{$key + 1}}</td> --}}
                    <td>
                        <img src="{{$item->medias->count() > 0 ? $item->medias->first->src : asset('/images/user.png')}}" width="30" height="30" data-toggle="modal" data-target="#model-{{ $key }}">

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
                    @if (auth()->guard(App\Models\Admin::$guard)->check())
                        <td>
                            <span class="text-sm">{{$item->fullname}}</span>
                        </td>
                    @endif
                    <td>
                        <span class="btn btn-light btn-sm">{{$item->matricule}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->start_date}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->end_date}}</span>
                    </td>
                    {{-- <td>
                        <span class="text-sm">{{$item->place_enjoyment}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->call_user_name}}</span>
                    </td> --}}
                    <td>
                        <a href="tel:{{$item->call_phone}}" class="text-sm">
                            <i class="fas fa-phone"></i>
                            {{$item->call_phone}}
                        </a>
                    </td>
                    @if (auth()->guard(App\Models\Admin::$guard)->check())
                        <td>
                            @php
                                $flow = $item->flows->where('signatory_id', auth()->guard(App\Models\Admin::$guard)->user()->id)->first();
                            @endphp
                            @if (!empty($flow))
                                <span class="text-sm btn-{{$flow->status == "PENDING" ? 'warning' : ($flow->status == "SUCCESS" ? 'success' : 'danger')}} btn-sm">{{$flow->status == 'PENDING' ? 'En cours' : ($flow->status == 'SUCCESS' ? 'Accepté' : 'Réfusé')}}</span>
                            @endif
                        </td>
                    @endif

                    <td>
                        <span class="text-sm btn-{{$item->status == "PENDING" ? 'warning' : ($item->status == "SUCCESS" ? 'success' : 'danger')}} btn-sm">{{$item->status == 'PENDING' ? 'En cours' : ($item->status == 'SUCCESS' ? 'Accepté' : 'Réfusé')}}</span>
                    </td>

                    <td>
                        @if (empty($item->signatory_id) && $item->status == "SUCCESS")
                            {{-- <a href="{{ getGuardedRoute('leaves.download', [$item->id]) }}" class='btn btn-info btn-sm'>
                                <i class="fas fa-file"></i>
                            </a> --}}
                            @if (!empty($item->flow))
                                <a href="{{$item->flow->media?->src}}" target="_blank" class='btn btn-info btn-sm'>
                                    <i class="fas fa-file"></i>
                                </a>
                            @else <i class="fa fa-ban" style="color: red;"></i>
                            @endif
                        @endif
                    </td>

                    <td  style="width: 120px">
                        <div x-data="{
                            show($item, $route) {
                                $('#update-leaves-modal').modal('show');
                                $('.leaves-form-action').attr('action', $route);
                            },
                        }" class='btn-group'>
                            @if (auth()->guard(App\Models\Admin::$guard)->check())
                                @can(App\Models\Permission::LEAVE['READ'])
                                    <a href="{{ getGuardedRoute('leaves.show', ['leaf' => $item->id, 'type' => request()->type]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <form action="{{ getGuardedRoute('leaves.download', $item->id) }}" method="GET">
                                        <button type="submit" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-file"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can(App\Models\Permission::LEAVE['UPDATE'])
                                    <a href="{{ getGuardedRoute('leaves.edit', ['leaf' => $item->id, 'type' => request()->type]) }}"
                                        class='btn btn-warning btn-sm'>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::LEAVE['SIGNER'])
                                    @if (!empty($item->signatory_id) && ($item->w_admin == 1 || $item->signatory_id == auth()->user()->id))
                                        <a href="{{ getGuardedRoute('leaves.appreciation', ['id' => $item->id, 'type' => request()->type]) }}"
                                            class='btn btn-info btn-sm'>
                                                <i class="fas fa-signature"></i>
                                        </a>
                                    @endif
                                @endcan

                                @can(App\Models\Permission::LEAVE['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'leaves.destroy', ['leaf' => $item->id, 'type' => request()->type]], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                @endcan
                            @else
                                <a href="{{ getGuardedRoute('leaves.show', ['leaf' => $item->id, 'type' => request()->type]) }}"
                                class='btn btn-primary btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>

                                {!! Form::open(['route' => [$guard . 'leaves.destroy', ['leaf' => $item->id, 'type' => request()->type]], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $leaves])
        </div>
    </div>
</div>

@include('leaves.modals.update')

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
