<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('infos.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="infos-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Emetteur</th>
                <th class="text-sm">Contact</th>
                <th class="text-sm">Poste</th>
                <th class="text-sm">Document</th>
                <th class="text-sm">Statut</th>
                @if (auth()->guard(\App\Models\Admin::$guard)->check())
                    <th class="text-sm" colspan="3">Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach($infos as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$item->post_name}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->post_phone}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->department->name ?? ''}}</span>
                        </td>

                        <td>
                            @if (!empty($item->media))
                                @if (pathinfo($item->media->src, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="{{$item->media->src}}" target="_blank">
                                        <i class="fa fa-file text-primary text-center"></i> <br>
                                        <small>Cliquez pour ouvrir</small>
                                    </a>
                                @else
                                    <img src="{{!empty($item->media) ? $item->media->src : asset('/images/user.png')}}" class="product-file" alt="Product File" width="30" height="30" data-toggle="modal" data-target="#model-{{ $key }}">

                                    <div class="modal fade" id="model-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $key }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{!empty($item->media) ? $item->media->src : asset('/images/user.png')}}" width="200" height="200">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else <i class="fa fa-ban" style="color: red;"></i>
                            @endif
                        </td>

                        <td>
                            <span class="text-sm btn-{{$item->status ? 'success' : 'warning'}} btn-sm">{{$item->status ? 'Visible' : 'En attente'}}</span>
                        </td>

                        @if (auth()->guard(\App\Models\Admin::$guard)->check())
                            <td  style="width: 120px">
                                <div x-data="{
                                    show($item, $route) {
                                        $('#update-infos-modal').modal('show');
                                        $('.infos-form-action').attr('action', $route);
                                        $('.post_name-input-field').val($item.post_name);
                                        $('.post_phone-input-field').val($item.post_phone);
                                        $('.departement-input-field').val($item.id);
                                        $('.content-input-field').val($item.content);
                                    },
                                }" class='btn-group'>
                                    @can(App\Models\Permission::INFO['READ'])
                                        <a href="{{ getGuardedRoute('infos.show', [$item->id]) }}"
                                        class='btn btn-primary btn-sm'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can(App\Models\Permission::INFO['UPDATE'])
                                        <a x-on:click="show({{$item}}, '{{getGuardedRoute('infos.update', $item->id)}}')" href="javascript:;" class='btn btn-info btn-sm'>
                                            <i class="far fa-edit"></i>
                                        </a>

                                        {!! Form::open(['route' => [$guard . 'infos.toogle', $item->id], 'method' => 'put']) !!}
                                            {!! Form::button('<i class="fa fa-' . ($item->status ? 'lock' : 'unlock') . '"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-sm', 'onclick' => "return confirm($item->status ? 'Voulez-vous désactivé cette information ?' : 'Voulez-vous rendre visible cette information ?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan

                                    @can(App\Models\Permission::INFO['DELETE'])
                                        {!! Form::open(['route' => [$guard . 'infos.destroy', $item->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </div>
                            </td>
                        @else
                            <td  style="width: 120px">
                                <div class='btn-group'>
                                    <a href="{{ getGuardedRoute('infos.show', [$item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $infos])
        </div>
    </div>
</div>

@include('infos.modals.update')

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
