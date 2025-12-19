<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('admins.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="admins-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Rôle</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($admins as $key => $admin)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$admin->name}}</span>
                        </td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$admin->email}}</span>
                        </td>
                        <td>
                            <span class="btn @if($admin->role->id == 1) btn-danger @elseif($admin->role->id == 2) btn-warning @else btn-info @endif btn-sm">{{$admin->role->name}}</span>
                        </td>
                        <td  style="width: 120px">
                            <div x-data="{
                                show($item, $route) {
                                    $('#update-admin-modal').modal('show');
                                    $('.admin-form-action').attr('action', $route);
                                    $('.admin-input-field').val($item.name);
                                    $('.admin-input-email-field').val($item.email);
                                    $('.admin-input-role-field').val($item.role.id);
                                },
                            }" class='btn-group'>
                                @can(\App\Models\Permission::ADMIN['UPDATE'])
                                    <a x-on:click="show({{$admin}}, '{{getGuardedRoute('admins.update', $admin->id)}}')" href="javascript:;" class='btn btn-primary btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(\App\Models\Permission::ADMIN['DELETE'])
                                    @if ($admin->role->id != 1)
                                        {!! Form::open(['route' => [$guard . 'admins.destroy', $admin->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        <a href="javascript:;" class='btn btn-default btn-sm'>
                                            <i class="fa fa-ban text-danger"></i>
                                        </a>
                                    @endif
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
            @include('adminlte-templates::common.paginate', ['records' => $admins])
        </div>
    </div>
</div>

@include('admins.modals.update')

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
