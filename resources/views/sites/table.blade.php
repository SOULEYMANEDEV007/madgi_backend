<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('sites.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="sites-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Site</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sites as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$item->name}}</span>
                        </td>

                        <td  style="width: 120px">
                            <div x-data="{
                                show($item, $route) {
                                    $('#update-sites-modal').modal('show');
                                    $('.sites-form-action').attr('action', $route);
                                    $('.name-input-field').val($item.name);
                                },
                            }" class='btn-group'>
                                @can(App\Models\Permission::SITE['UPDATE'])
                                    <a x-on:click="show({{$item}}, '{{getGuardedRoute('sites.update', $item->id)}}')" href="javascript:;" class='btn btn-warning btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::SITE['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'sites.destroy', $item->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $sites])
        </div>
    </div>
</div>

@include('sites.modals.update')

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
