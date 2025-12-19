<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('certificates.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="certificates-table">
            <thead>
            <tr>
                <th class="text-sm">Photo</th>
                <th class="text-sm">Nom et Prénom(s)</th>
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Date de demande</th>
                <th class="text-sm">Date de traitement</th>
                <th class="text-sm">Décision finale</th>
                <th class="text-sm">Type</th>
                <th class="text-sm">Document</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certificates as $key => $item)
                <tr>
                    <td>
                        <img src="{{$item->user->photo != null ? $item->user->photo : asset('/images/user.png')}}" width="30" height="30" data-toggle="modal" data-target="#model-{{ $key }}">

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
                        <span class="text-sm">{{$item->fullname}}</span>
                    </td>
                    <td>
                        <span class="btn btn-light btn-sm">{{$item->matricule}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</span>
                    </td>
                    <td>
                        @if ($item->status != 'PENDING')
                            <span class="text-sm">{{\Carbon\Carbon::parse($item->updated_at)->format('d/m/Y')}}</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->status == "SUCCESS") <span class="text-sm btn-success btn-sm">Accepté</span>
                        @elseif ($item->status == "PENDING") <span class="text-sm btn-warning btn-sm">En cours</span>
                        @elseif ($item->status == "RECOVER") <span class="text-sm btn-info btn-sm">Document récupérer</span>
                        @else <span class="text-sm btn-danger btn-sm">Réfusé</span>
                        @endif
                    </td>

                    <td>
                        <span class="text-sm btn-light btn-sm">{{$item->type}}</span>
                    </td>

                    <td>
                        @if ($item->status == "SUCCESS" && !empty($item->media))
                            <a href="{{$item->media->src}}" download="" class='btn btn-info btn-sm'>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </td>

                    <td style="width: 120px">
                        <div class='btn-group'>
                            @if (auth()->guard(\App\Models\Admin::$guard)->check())
                                @can(App\Models\Permission::CERTIFICAT['READ'])
                                    <a href="{{ getGuardedRoute('certificates.show', [$item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <form action="{{ getGuardedRoute('certificates.download', $item->id) }}" method="GET">
                                        <button type="submit" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Modèle de certificat">
                                            <i class="fa fa-file"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can(App\Models\Permission::CERTIFICAT['UPDATE'])
                                    @if ($item->status != 'RECOVER')
                                        <a href="{{ getGuardedRoute('certificates.doc-edit', [$item->id]) }}"
                                            class='btn btn-warning btn-sm'>
                                                <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if ($item->status != 'RECOVER')
                                        <a href="{{ getGuardedRoute('certificates.edit', [$item->id]) }}"
                                            class='btn btn-info btn-sm'>
                                                <i class="fas fa-signature"></i>
                                        </a>
                                    @endif
                                @endcan

                                @can(App\Models\Permission::CERTIFICAT['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'certificates.destroy', $item->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                @endcan
                            @else
                                <a href="{{ getGuardedRoute('certificates.show', [$item->id]) }}"
                                class='btn btn-primary btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>

                                @if ($item->status != 'RECOVER')
                                    <a href="{{ getGuardedRoute('certificates.doc-edit', [$item->id]) }}"
                                        class='btn btn-warning btn-sm'>
                                            <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                {!! Form::open(['route' => [$guard . 'certificates.destroy', $item->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $certificates])
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
