<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="holidays-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Titre</th>
                <th class="text-sm">Date</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($holidays as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light border border-primary btn-sm">{{$item->name}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</span>
                        </td>

                        <td  style="width: 120px">
                            <div x-data="{
                                show($item, $route) {
                                    $('#update-holidays-modal').modal('show');
                                    $('.holidays-form-action').attr('action', $route);
                                    $('.name-input-field').val($item.name);
                                    $('.date-input-field').val($item.date);
                                },
                            }" class='btn-group'>
                                @can(App\Models\Permission::HOLIDAY['UPDATE'])
                                    <a x-on:click="show({{$item}}, '{{getGuardedRoute('holidays.update', $item->id)}}')" href="javascript:;" class='btn btn-info btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::HOLIDAY['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'holidays.destroy', $item->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $holidays])
        </div>
    </div>
</div>

@include('holidays.modals.update')
