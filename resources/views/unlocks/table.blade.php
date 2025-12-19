<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="unlocks-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Photo</th>
                <th class="text-sm">Matricule</th>
                <th class="text-sm">Nom et Prénom(s)</th>
                <th class="text-sm">Nb de blocage</th>
                <th class="text-sm">Bloqué le</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unlocks as $key => $item)
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
                        <span class="text-sm">{{$item->lock_nb}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->lock_date}}</span>
                    </td>

                    <td style="width: 120px">
                        <div x-data="{
                            show($item, $route) {
                                $('#update-unlocks-modal').modal('show');
                                $('.unlocks-form-action').attr('action', $route);
                                $('.unlocks-input-field').val($item.name);
                            },
                        }" class='btn-group'>
                            @can(App\Models\Permission::UNLOCK['READ'])
                                <a href="{{ getGuardedRoute('workers.show', [$item->id]) }}"
                                class='btn btn-primary btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan

                            @can(App\Models\Permission::UNLOCK['UPDATE'])
                                <a x-on:click="show({{$item}}, '{{getGuardedRoute('unlocks.update', $item->id)}}')" href="javascript:;" class='btn btn-warning btn-sm'>
                                    <i class="far fa-edit"></i>
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
            @include('adminlte-templates::common.paginate', ['records' => $unlocks])
        </div>
    </div>
</div>

@include('unlocks.modals.update')
