<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="roles-table">
            <thead>
            <tr>
                <th>Rôle</th>
                <th>Permissions</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>
                        <span class="btn @if($role->id == 1) btn-danger @elseif($role->id == 2) btn-warning @else btn-info @endif btn-sm">{{$role->name}}</span>
                    </td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            <span class="btn btn-secondary btn-sm" style="border-radius: 9999px; font-size: 10px; background-color: rgb(226 232 240/.7); border-color: rgb(226 232 240/.7); color: rgb(100 116 139/var(--tw-text-opacity)); margin: 2px 0;">{{$permission->name}}</span>
                        @endforeach
                    </td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            @can(\App\Models\Permission::ROLE['UPDATE'])
                                <a href="{{ getGuardedRoute('roles.edit', [$role->id]) }}" class='btn btn-primary btn-sm'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan

                            @can(\App\Models\Permission::ROLE['DELETE'])
                                {!! Form::open(['route' => [$guard . 'roles.destroy', $role->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $roles])
        </div>
    </div>
</div>
